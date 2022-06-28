<?php

namespace app\models;

class basket extends Model
{
    public $id;
    public $id_product;
    public $id_session;

    public function getTableName()
    {
        return "basket";
    }
}