<?php

namespace app\models;

class Products extends DBModel
{
    protected $id;
    protected $name;
    protected $price;
    protected $description;
    protected $img;
    protected $likes;

    protected $props = [ // свойства чтобы отловить update
        "name" => false,
        "price" => false,
        "description" => false,
        "img" => false,
        "likes" => false,
    ];

    public function __construct($name = null, $price = null, $description = null, $img = null, $likes = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->img = $img;
        $this->likes = $likes;
    }

    public static function getTableName()
    {
        return "products";
    }
}

