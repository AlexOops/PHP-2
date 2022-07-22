<?php

namespace app\controllers;

use app\models\repositories\BasketRepository;
use app\engine\{Request, Session};
use app\models\entities\Basket;

class BasketController extends Controller
{
    public function actionIndex() // весь каталог
    {
        $id_session = (new Session())->getId();
        $products = (new BasketRepository())->getBasket($id_session);
        echo $this->render('basket', [
            'basket' => $products,
        ]);
    }

    public function actionAdd() // в корзину
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->getId();

        $basket = new Basket($id_product, $id_session); // создаем сущность
        (new BasketRepository())->save($basket);  // сохраняем сущность через хранилище

        $response = [
            'status' => "ok",
            'count' => (new BasketRepository())->getCountWhere('id_session', $id_session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionDelete()
    {
        $id_product = (new Request())->getParams()['id'];
        $id_session = (new Session())->getId();
        $error = "ok";

        $basket = (new BasketRepository())->getOne($id_product);
        if ($id_session == $basket->id_session) {
            (new BasketRepository())->delete($basket);
        } else {
            $error = "Ошибочка!";
        }

        $response = [
            'status' => $error,
            'count' => (new BasketRepository())->getCountWhere('id_session', $id_session)
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        die();
    }
}