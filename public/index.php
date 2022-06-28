<?php
include "../engine/Autoload.php";

//todo Доделать autoload через USE

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Db as Db2, Basket, Feedbacks, Orders};

spl_autoload_register([new Autoload(), 'loadClass']); // магический метод

$db1 = new Db();
//$db2 = new Db2; //models

$products = new Products();
$users = new Users();
$basket = new Basket();

echo $products->getOne(2);
echo $products->getAll();
echo $users->getOne(1);
echo $users->getAll();

echo $basket->getOne(2);
echo $basket->getAll();



