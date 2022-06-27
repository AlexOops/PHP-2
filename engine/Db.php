<?php

namespace app\engine;

class Db extends \app\models\Db
{
    //1
    public function queryOne($sql)
    {
        return $sql ."<br>";
    }

    //all
    public function queryAll($sql)
    {
        return $sql ."<br>";
    }
}