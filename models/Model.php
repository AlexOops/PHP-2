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

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return Db::queryOne($sql);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return  Db::queryAll($sql);
    }
}