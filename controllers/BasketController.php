<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() // весь каталог
    {
        $id_session = (new Session())->sessionId();
        $products = Basket::getBasket($id_session);
        echo $this->render('basket', [
            'basket' => $products,
        ]);
    }

    public function actionAdd() // в корзину
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->sessionId();
        (new Basket($id_product, $id_session))->save();

        header("Location: /products/catalog");
        die();
    }
}