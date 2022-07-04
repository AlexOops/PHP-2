<?php

namespace app\models;

class Users extends DBModel
{
    public $id;
    public $login;
    public $pass;
    public $hash;

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }

    public static function getTableName()
    {
        return "users";
    }
}