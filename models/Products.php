<?php

namespace app\models;

class Products extends Model
{
    protected $id;
    protected $name;
    protected $description;
    protected $img;
    protected $likes;

    protected $tableName = "products";

}

