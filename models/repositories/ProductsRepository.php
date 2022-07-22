<?php

namespace app\models\repositories;

use app\models\entities\Products;
use app\models\Repository;

class ProductsRepository extends Repository
{
    protected function getEntityClass()
    {
        return Products::class;
    }

    protected function getTableName()
    {
        return "products";
    }
}