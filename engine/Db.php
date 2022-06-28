<?php

namespace app\engine;

class Db
{
    //1
    public static function queryOne($sql)
    {
        return $sql ."<br>";
    }

    //all
    public static function queryAll($sql)
    {
        return $sql ."<br>";
    }
}