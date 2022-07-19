<?php

namespace app\controllers;

use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() // весь каталог
    {
        $id_session = session_id();
        $products = Basket::getBasket($id_session);
        echo $this->render('basket', [
            'basket' => $products,
        ]);
    }

    public function actionAdd() // в корзину
    {
        $id_product = $_POST['id']; // input hidden post
        $id_session = session_id();
        (new Basket($id_product, $id_session))->save();

        header("Location: /products/catalog");
        die();
    }
}