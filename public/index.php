<?php
include "../engine/Autoload.php";

spl_autoload_register([new Autoload(), 'loadClass']); // магический метод


$products = new Products;
$users = new Users;
$db = new Db;

