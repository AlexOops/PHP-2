<?php
session_start();

include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload, Render, TwigRender, Request};
use app\models\{Users, Products, Basket, Feedbacks, Orders};
use app\config\Config;

require_once "../vendor/autoload.php"; // регистрируется автозагрузчик

spl_autoload_register([new Autoload(), 'loadClass']); // магический метод

$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = Config::CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
// минироутинг
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName); // передали в управление роутеру
} else {
    die("404");
}




