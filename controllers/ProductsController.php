<?php

namespace app\controllers;

use app\engine\Request;
use app\models\repositories\ProductsRepository;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog() // весь каталог
    {
        $page = (new Request())->getParams()['page'] ?? 0;
        $products = (new ProductsRepository())->getLimit(($page + 1) * 2);
        echo $this->render('catalog/index', [
            'products' => $products,
            'page' => ++$page,
        ]);
    }

    public function actionProduct() // один продукт
    {
        $id = (new Request())->getParams()['id'];
        $product = (new ProductsRepository())->getOne($id);
        echo $this->render('catalog/product', [
            'product' => $product
        ]);
    }
}