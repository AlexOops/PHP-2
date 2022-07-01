<?php
include "../config/Config.php";
include "../engine/Autoload.php";

use app\engine\{Db, Autoload};
use app\models\{Users, Products, Basket, Feedbacks, Orders};


spl_autoload_register([new Autoload(), 'loadClass']); // магический метод


$products = new Products("Boat",100, "The fastest","img4.jpg", 0);
//$products->insert();
//$products->remove(6);


//$user = new Users('user1', 123, 123);
//$user->insert();





