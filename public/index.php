<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Basket, Feedbacks, Orders};


spl_autoload_register([new Autoload(), 'loadClass']); // магический метод





$products = new Products("Лодка с мотором", "Быстрая, классная, удобная","img4.jpg", "0");
var_dump($products->insert());
//var_dump($products->getOne(2));


