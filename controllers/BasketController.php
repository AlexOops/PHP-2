<?php

namespace app\controllers;

use app\models\Basket;

class BasketController extends Controller
{
    protected $defaultAction = "basket";

    public function actionIndex()
    {
        echo $this->render('basket');
    }

    public function actionBasket() // весь каталог
    {
        //TODO сделать через Object и запрос на объдтнение 2 таблиц
        $products = Basket::getAll();
        echo $this->render('basket', [
            'basket' => $products,
        ]);
    }
}