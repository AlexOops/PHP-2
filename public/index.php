<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Basket, Feedbacks, Orders};

spl_autoload_register([new Autoload(), 'loadClass']); // магический метод

$db = new Db();


$products = new Products();
$users = new Users();
$basket = new Basket();

var_dump($products->getOne(2));
var_dump ($products->getAll());
var_dump ($users->getOne(1));
var_dump ($users->getAll());



