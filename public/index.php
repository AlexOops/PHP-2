<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Basket, Feedbacks, Orders};


spl_autoload_register([new Autoload(), 'loadClass']); // магический метод


//$products = new Products("boat12",100, "The fastest","img4.jpg", 0);
//$products->save();

//$products = Products::getOne(2);
//$products->price = 333;
//$products->save();

//$products->delete();





