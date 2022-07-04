<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;


abstract class Model implements IModel
{

    abstract public function getTableName();

    public function __get($value)
    {
        return $this->$value;
    }

    public function __set(string $name, $value)
    {
        return $this->$name = $value;
    }

    public function insert()
    {
        $fields = [];
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $fields[] = $key;
            $params[":$key"] = $this->$key; // посмотреть
        }
        $fields = implode(", ", $fields);
        $values = implode(", ", array_keys($params)); // по ключам :value :value
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName}({$fields})VALUES({$values})";
        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertid(); //  записали в этот объект id
        return $this;
    }

    public function update($id)
    {
        $fields = [];
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $fields[] = $key;
            $params[":$key"] = $this->$key;
        }
        $fields = implode(", ", $fields);
        $values = implode(", ", array_keys($params)); // по ключам :value :value
        $tableName = $this->getTableName();

//        UPDATE `products` SET `id`='[value-1]',`name`='[value-2]',`price`='[value-3]',`description`='[value-4]',`img`='[value-5]',`likes`='[value-6]' WHERE 1
        $sql = "UPDATE {$tableName} SET {$fields}{$values} WHERE 'id' => {$id}";
        var_dump($sql);
        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function remove($id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $count = Db::getInstance()->execute($sql, ['id' => $id]);
        print("Удалено $count строк.\n");
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
//        return Db::getInstance()->queryOne($sql, ['id' => $id]); //getInstance() позволит статично обратиться к Db
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class()); // Вернет объект
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
}