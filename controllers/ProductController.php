<?php

namespace app\controllers;
use app\models\Products;

class ProductController extends Controller
{
    protected $defaultAction = "index";

    public function actionCatalog() // весь каталог
    {
        $page = $_GET['page'] ?? 0;
        //TODO сделать через Object
        $products = Products::getLimit(($page + 1) * 2);
        echo $this->render('catalog', [
            'products' => $products,
            'page' => ++$page,
        ]);
    }

    public function actionProduct() // один продукт
    {
        $id = $_GET['id'];
        $product = Products::getOne($id);
        echo $this->render('product', [
            'product' => $product
        ]);
    }
}