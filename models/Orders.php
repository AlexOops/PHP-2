<?php

namespace app\models;

class Orders extends DBModel
{
    public $id;
    public $name;
    public $phone;
    public $id_session;

    public static function getTableName()
    {
        return "orders";
    }
}