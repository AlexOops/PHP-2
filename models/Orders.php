<?php

namespace app\models;

class Orders extends DBModel
{
    protected $id;
    protected $name;
    protected $phone;
    protected $id_session;

    protected $props = [
        "name" => false,
        "phone" => false,
        "id_session" => false,
    ];

    public static function getTableName()
    {
        return "orders";
    }
}