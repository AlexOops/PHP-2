<?php

namespace app\models;

use app\engine\Request;
use app\engine\Session;

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
            (new Session())->set('login', $login);
//            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public static function isAuth() // проверка на логин
    {

        return (new Session())->get('login') !== null;
//        return isset($_SESSION['login']);
    }

    public static function isAdmin() // проверка на админа
    {
        return (new Session())->get('admin') == 'admin';
    }

    public static function getName() // имя залог пользователя
    {
        return (new Session())->get('login');
    }

    public static function getTableName()
    {
        return "users";
    }
}