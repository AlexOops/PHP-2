<?php

namespace app\controllers;

use app\config\Config;
use app\models\Products;

abstract class Controller
{
    protected $action;
    protected $defaultAction = "index";
    protected $layout = "main";
    protected $useLayout = true;

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) { // проверка на существование метода
            $this->$method(); // динамически вызываем из переменной
        }
    }

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemlate("layout/" . $this->layout, [ //собирает main
                'menu' => $this->renderTemlate('menu', $params),
                'content' => $this->renderTemlate($template, $params),
            ]);
        } else {
            return $this->renderTemlate($template, $params = []);
        }
    }

    public function renderTemlate($template, $params = []) // ($шабон, $значение переменных для подстановки)
    {
        ob_start(); // вкл буфер
        extract($params);
        $templatePath = Config::VIEWS_DIR . $template . ".php"; //собирается имя
        include $templatePath;
        return ob_get_clean(); // возвращает весь HTML и очищает
    }
}