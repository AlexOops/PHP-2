<?php

namespace app\models;

class Products extends Model
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $img;
    public $likes;

    public function __construct($name = null, $price = null, $description = null, $img = null, $likes = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->img = $img;
        $this->likes = $likes;
    }

    public function getTableName()
    {
        return "products";
    }
}

