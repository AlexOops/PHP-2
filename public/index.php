<?php
//error_reporting(0);
session_start();

include "../config/Config.php";
//include "../engine/Autoload.php";

use app\engine\{Db, Autoload, Render, TwigRender, Request};
use app\config\Config;

require_once "../vendor/autoload.php"; // регистрируется автозагрузчик

//spl_autoload_register([new Autoload(), 'loadClass']); // магический метод

try {

    $request = new Request;

    $controllerName = $request->getControllerName() ?: 'products';
    $actionName = $request->getActionName();

    $controllerClass = Config::CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

    // минироутинг
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass(new TwigRender()); // Render()
        $controller->runAction($actionName); // передали в управление роутеру
    } else {
        die("404");
    }

} catch (\PDOException $e) {
    var_dump($e->getMessage());
} catch (\Exception $e){
    var_dump($e);
}







