<?php

namespace app\models;

class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $img;
    public $likes;

    public function __construct($name = null, $description = null, $img = null, $likes = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->img = $img;
        $this->likes = $likes;
    }


    public function getTableName()
    {
        return "products";
    }
}

