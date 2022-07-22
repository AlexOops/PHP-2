<?php

namespace app\models\repositories;

use app\engine\Db;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{
    public function getBasket($id_session)
    {
        $sql = "SELECT basket.id as basket_id, basket.id_session, products.id as product_id, products.name, img, description, price FROM basket, products WHERE basket.id_product =products.id AND id_session = :id_session";
        return Db::getInstance()->queryAll($sql, ['id_session' => $id_session]);
    }

    protected function getEntityClass()
    {
        return Basket::class;
    }

    protected function getTableName()
    {
        return "basket";
    }
}