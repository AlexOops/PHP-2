<?php

namespace app\controllers;

use app\engine\{Request, Session};
use app\models\Basket;

class BasketController extends Controller
{
    public function actionIndex() // весь каталог
    {
        $id_session = (new Session())->getId();
        $products = Basket::getBasket($id_session);
        echo $this->render('basket', [
            'basket' => $products,
        ]);
    }

    public function actionAdd() // в корзину
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->getId();
        (new Basket($id_product, $id_session))->save();

        $response = [
            'status' => "ok",
            'count' => Basket::getCountWhere('id_session', $id_session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->getId();
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
        die();
    }
}