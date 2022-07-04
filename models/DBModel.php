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
        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $fields[] = $key;
            $params[":$key"] = $value; // посмотреть
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
        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $fields[] = $key;
            $params[":$key"] = $value;
        }
        $fields = implode(", ", $fields);
        $values = implode(", ", array_keys($params)); // по ключам :value :value
        $tableName = static::getTableName();

//        UPDATE `products` SET `id`='[value-1]',`name`='[value-2]',`price`='[value-3]',`description`='[value-4]',`img`='[value-5]',`likes`='[value-6]' WHERE 1
        $sql = "UPDATE {$tableName} SET {$fields}{$values} WHERE 'id' => {$this->id}";
        var_dump($sql);
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $count = Db::getInstance()->execute($sql, ['id' => $this->id]);
        echo("Удалено $count строк.\n"); // пофиксить, не должны возвращать echo
    }

    public function save()
    {
        // TODO вызвать либо insert либо update
        // проверить $this->id, если определен - update, если не определен - insert
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
            echo "Опа, ошибочка -_-"; // пофиксить, не должны возвращать echo
        }
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
}