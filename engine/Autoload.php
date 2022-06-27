<?php
namespace app\engine;

class Autoload
{
    public function loadClass($className)
    {
        $filename = "{$className}.php";
        $path = str_replace('app', "../", $filename);
        if (file_exists($path)) {
            include $path;
        }
    }
}


