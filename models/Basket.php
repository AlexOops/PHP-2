<?php

namespace app\models;

use app\engine\Db;

class Basket extends DBModel
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

    public static function getBasket($id_session)
    {
        $sql = "SELECT basket.id as basket_id, basket.id_session, products.id as product_id, products.name, img, description, price FROM basket, products WHERE basket.id_product =products.id AND id_session = :id_session";
        return Db::getInstance()->queryAll($sql, ['id_session' => $id_session]);
    }

    public static function getTableName()
    {
        return "basket";
    }
}