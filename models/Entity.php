<?php

namespace app\models;


abstract class Entity
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

    public function __isset($name)
    {
        return isset($this->name);
    }
}