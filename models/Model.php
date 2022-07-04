<?php

namespace app\models;

use app\interfaces\IModel;
use app\engine\Db;


abstract class Model implements IModel
{
    public function __get($value)
    {
        return $this->$value;
    }

    public function __set(string $name, $value)
    {
        return $this->$name = $value;
    }
}