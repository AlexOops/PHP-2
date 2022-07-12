<?php

namespace app\controllers;

use app\models\Products;

class ProductController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog() // весь каталог
    {
        $page = $_GET['page'] ?? 0;
        //TODO сделать через Object
        $products = Products::getLimit(($page + 1) * 2);
        echo $this->render('catalog/index', [
            'products' => $products,
            'page' => ++$page,
        ]);
    }

    public function actionProduct() // один продукт
    {
        $id = $_GET['id'];
        $product = Products::getOne($id);
        echo $this->render('catalog/product', [
            'product' => $product
        ]);
    }
}