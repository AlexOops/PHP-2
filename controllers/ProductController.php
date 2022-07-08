<?php

namespace app\controllers;

use app\config\Config;

class ProductController
{
    private $action;
    private $defaultAction = "catalog";

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) { // проверка на существование метода
            $this->$method(); // динамически вызываем из переменной
        }
    }

    public function renderIndex()
    {
        echo $this->renderTemlate('index');
    }

    public function actionCatalog()
    {
        echo "product";
    }

    public function actionProduct()
    {
        echo "card";
    }

    public function renderTemlate($template, $params) // ($шабон, $значение переменных для подстановки)
    {
        ob_start(); // вкл буфер
        extract($params);
        $templatePath = Config::VIEWS_DIR . $template . "php";
        include $templatePath;
        return ob_get_clean(); // возвращает весь HTML и очищает
    }
}