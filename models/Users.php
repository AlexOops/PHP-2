<?php

namespace app\models;

class Users extends DBModel
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
        "login" => false,
        "pass" => false,
        "hash" => false,
    ];

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }

    public static function auth($login, $pass)
    {
        $user = Users::getOneWhere('login', $login);
        if ($user && password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public static function isAuth() // проверка на логин
    {
        return isset($_SESSION['login']);
    }

    public static function isAdmin() // проверка на админа
    {
        return $_SESSION['login'] == 'admin';
    }

    public static function getName() // имя залог пользователя
    {
        return $_SESSION['login'];
    }

    public static function getTableName()
    {
        return "users";
    }
}