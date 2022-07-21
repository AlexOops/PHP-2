<?php

namespace app\models;

use app\engine\Db;

abstract class DBModel extends Model
{
    abstract protected static function getTableName();

    public function insert()
    {
        $fields = [];
        $params = [];

        foreach ($this->props as $key => $value) {
            if ($key == "id") continue; // обойти это тело по другому
            $fields[] = $key;
            $params[":$key"] = $this->$key; // из ключа имя поля
        }

        $fields = implode(", ", $fields);
        $values = implode(", ", array_keys($params)); // по ключам :value :value
        $tableName = $this->getTableName();

        $sql = "INSERT INTO {$tableName}({$fields})VALUES({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertid(); //  записали в этот объект id
        return $this;
    }

    public function update()
    {
        $fields = [];
        $params = [];

        foreach ($this->props as $key => $value) {
            if (!$value) continue; // игнорируем поле, которое не встретилось
            $fields["$key"] .= "{$key} = :{$key}"; // SET('name')('name'=':name')
            $params[":$key"] = $this->$key;
            $this->props[$key] = false;
        }

        $tableName = static::getTableName();
        $fields = implode(", ", $fields);
        $params['id'] = $this->id;

        $sql = "UPDATE {$tableName} SET {$fields} WHERE id = :id";
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]); //getInstance() позволит статично обратиться к Db
        $result = Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class()); // Вернет объект
        if ($result) {
            return $result;
        } else {
            return print_r("Опа, ошибочка -_-");// пофиксить
        }
    }

    public static function getLimit($limit)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return Db::getInstance()->queryLimit($sql, $limit); // текст запроса и значение
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);

    }

    public static function getOneWhere($name, $value) // авторизация
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
    }

    public static function getCountWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }
}