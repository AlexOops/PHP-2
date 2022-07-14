<?php

namespace app\controllers;

use app\engine\Request;
use app\engine\Session;
use app\models\Users;


class AuthController extends Controller
{

    public function actionLogin()
    {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];

        if (Users::auth($login, $pass)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die("Неверный логин или пароль!");
        }
    }

    public function actionLogout()
    {
        (new Session())->sessionRegenerateId();
        (new Session())->destroy();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }
}