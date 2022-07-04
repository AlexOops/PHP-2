<?php

namespace app\models;

class feedbacks extends DBModel
{
    public $id;
    public $name;
    public $feedback;
    public $id_product;

    public static function getTableName()
    {
        return "feedbacks";
    }
}