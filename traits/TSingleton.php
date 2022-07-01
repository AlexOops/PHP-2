<?php

namespace app\traits;

trait TSingleton
{
    //реализуек класс - singleton
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static(); // static позволит включиться в любой класс
        }
        return static::$instance;
    }

    //запрещаем создавать объект класса
    private function __construct() {}

    private function __clone() {}

    private function wakeup() {}
}