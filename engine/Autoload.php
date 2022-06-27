<?php

class Autoload
{
    public $paths = [
        'engine',
        'models',
    ];

    public function loadClass($className)
    {
        foreach ($this->paths as $path) {
            $filename = "../{$path}/{$className}.php";
            if (file_exists($filename)) {
                include $filename;
            }
        }
    }
}


