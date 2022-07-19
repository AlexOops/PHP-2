<?php

namespace app\controllers;

use app\engine\Request;
use app\models\Products;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog() // весь каталог
    {
        $page = (new Request())->getParams()['page'] ?? 0;
        $products = Products::getLimit(($page + 1) * 2);
        echo $this->render('catalog/index', [
            'products' => $products,
            'page' => ++$page,
        ]);
    }

    public function actionProduct() // один продукт
    {
        $id = (new Request())->getParams()['id'];
        $product = Products::getOne($id);
        echo $this->render('catalog/product', [
            'product' => $product
        ]);
    }
}