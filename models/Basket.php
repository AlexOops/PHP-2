<?php

namespace app\models;

class basket extends DBModel
{
    public $id;
    public $id_product;
    public $id_session;

    public static function getTableName()
    {
        return "basket";
    }
}