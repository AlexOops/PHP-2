<?php

namespace app\controllers;

use app\engine\Session;
use app\interfaces\IRender;
use app\models\repositories\{UsersRepository, BasketRepository};

abstract class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layout = "main";
    private $useLayout = true;
    protected $render;

    public function __construct(IRender $render) // передаем снаружи
    {
        $this->render = $render; // содаем экз
    }

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) { // проверка на существование метода
            $this->$method(); // динамически вызываем из переменной
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layout/" . $this->layout, [ //собирает main
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => (new UsersRepository())->isAuth(), // залогинен ли
                    'username' => (new UsersRepository())->getName(), // вернет имя польователя
                    'count' => (new BasketRepository())->getCountWhere('id_session', (new Session())->getId()),
                ]),
                'content' => $this->renderTemplate($template, $params),
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->render->renderTemplate($template, $params);
    }
}