<?php

namespace app\models;

use app\interfaces\IModel;


abstract class Model implements IModel
{
    protected $props = []; //обнуляем, чтобы был доступен

    public function __get($value)
    {
        return $this->$value;
    }

    public function __set(string $name, $value)
    {
        $this->props[$name] = true; // по ключу в true
        return $this->$name = $value;
    }
}