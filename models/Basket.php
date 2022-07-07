<?php

namespace app\models;

class basket extends DBModel
{
    protected $id;
    protected $id_product;
    protected $id_session;

    protected $props = [
        "id_product" => false,
        "id_session" => false,
    ];

    public function __construct($id_product = null, $id_session = null)
    {
        $this->id_product = $id_product;
        $this->id_session = $id_session;
    }

    public static function getTableName()
    {
        return "basket";
    }
}