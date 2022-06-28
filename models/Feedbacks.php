<?php

namespace app\models;

class feedbacks extends Model
{
    public $id;
    public $name;
    public $feedback;
    public $id_product;

    public function getTableName()
    {
        return "feedbacks";
    }
}