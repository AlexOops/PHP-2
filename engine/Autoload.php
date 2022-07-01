<?php

namespace app\engine;

use app\config\Config;

class Autoload
{
    public function loadClass($className)
    {
        $path = str_replace(['app\\', '\\'], [Config::DIR . Config::DS, Config::DS], $className) . ".php";
        if (file_exists($path)) {
            include $path;
        }
    }
}


