<?php

namespace app\models;

class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $img;
    public $likes;



    public function getTableName()
    {
        return "products";
    }
}

