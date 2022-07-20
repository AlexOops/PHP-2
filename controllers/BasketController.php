<?php

namespace app\controllers;

use app\engine\{Request, Session};
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
//        header("Location: /products/catalog");
//        die();
        $response = [
            'status' => "ok",
            'count' => Basket::getCountWhere('id_session', $id_session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDel() // в корзину
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->sessionId();
        $error = "ok";

        $basket = Basket::getOne($id_product);
        if ($id_session == $basket->id_session) {
            $basket->delete();
        } else {
            $error = "Ошибочка!";
        }

        $response = [
            'status' => $error,
            'count' => Basket::getCountWhere('id_session', $id_session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

//        header("Location: /basket");
        die();
    }
}