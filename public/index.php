<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Basket, Feedbacks, Orders};


spl_autoload_register([new Autoload(), 'loadClass']); // магический метод

/** @var Products $products */

//$products = new Products("boat12",100, "The fastest","img4.jpg", 0);
//$products->insert();


//$products = Products::getOne(6);
//$products->price = 333;
//$products->update();

//$products->delete();





