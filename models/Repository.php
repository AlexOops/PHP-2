<?php

namespace app\models;

use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    public function insert(Entity $entity)
    {
        $fields = [];
        $params = [];

        foreach ($entity->props as $key => $value) {
            if ($key == "id") continue; // обойти это тело по другому
            $fields[] = $key;
            $params[":$key"] = $entity->$key; // из ключа имя поля
        }

        $fields = implode(", ", $fields);
        $values = implode(", ", array_keys($params)); // по ключам :value :value
        $tableName = $this->getTableName();

        $sql = "INSERT INTO {$tableName}({$fields})VALUES({$values})";
        Db::getInstance()->execute($sql, $params);
        $entity->id = Db::getInstance()->lastInsertid(); //  записали в этот объект id
        return $this;
    }

    public function update(Entity $entity)
    {
        $fields = [];
        $params = [];

        foreach ($entity->props as $key => $value) {
            if (!$value) continue; // игнорируем поле, которое не встретилось
            $fields["$key"] .= "{$key} = :{$key}"; // SET('name')('name'=':name')
            $params[":$key"] = $entity->$key;
            $entity->props[$key] = false;
        }

        $tableName = $this->getTableName();
        $fields = implode(", ", $fields);
        $params['id'] = $entity->id;

        $sql = "UPDATE {$tableName} SET {$fields} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $entity->id]);
    }

    public function save(Entity $entity)
    {
        if (is_null($entity->id)) {
            $this->insert($entity);
        } else {
            $this->update($entity);
        }
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        $result = Db::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass()); // Вернет объект
        if ($result) {
            return $result;
        } else {
            return print_r("Опа, ошибочка -_-");// пофиксить
        }
    }

    public function getLimit($limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit); // текст запроса и значение
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);

    }

    public function getOneWhere($name, $value) // авторизация
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }
}