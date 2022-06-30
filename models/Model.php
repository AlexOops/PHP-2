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
            $values[] = $value;
        }
        $fields = implode(", ", $fields);
        $values = "'" . implode("', '", $values) . "'";
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName}({$fields})VALUE ({$params})";


    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryOne($sql, ['id' => $id]); //getInstance() позволит статично обратиться к Db
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }
}