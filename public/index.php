<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload, Render, TwigRender};
use app\models\{Users, Products, Basket, Feedbacks, Orders};
use app\config\Config;

require_once "../vendor/autoload.php"; // регистрируется автозагрузчик

spl_autoload_register([new Autoload(), 'loadClass']); // магический метод



$controllerName = $_GET['c'] ?? 'product';
$actionName = $_GET['a'];

$controllerClass = Config::CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";
// минироутинг
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new TwigRender());
    $controller->runAction($actionName); // передали в управление роутеру
} else {
    die("404");
}




