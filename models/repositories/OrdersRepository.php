<?php

namespace app\models\repositories;

use app\models\entities\Orders;
use app\models\Repository;

class OrdersRepository extends Repository
{
    protected function getEntityClass()
    {
        return Orders::class;
    }

    protected function getTableName()
    {
        return "orders";
    }
}