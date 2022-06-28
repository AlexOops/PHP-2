<?php

namespace app\models;

class Orders extends Model
{
    public $id;
    public $name;
    public $phone;
    public $id_session;

    public function getTableName()
    {
        return "orders";
    }
}