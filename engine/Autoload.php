<?php
namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $filename = "{$className}.php";
        $path = str_replace('app',"../", $filename); //посмотреть детально левые на правые
        $path = str_replace('\\',"/", $path);

        if (file_exists($path)) {
            include $path;
        }
    }
}


