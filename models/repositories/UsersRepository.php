<?php

namespace app\models\repositories;

use app\engine\Session;
use app\models\entities\Users;
use app\models\Repository;

class UsersRepository extends Repository
{
    public function auth($login, $pass)
    {
        $user = $this->getOneWhere('login', $login);
        if ($user && password_verify($pass, $user->pass)) {
            (new Session())->set('login', $login);
            return true;
        }
        return false;
    }

    public function isAuth() // проверка на логин
    {
        return (new Session())->get('login') !== null;
    }

    public function isAdmin() // проверка на админа
    {
        return (new Session())->get('admin') == 'admin';
    }

    public function getName() // имя залог пользователя
    {
        return (new Session())->get('login');
    }

    protected function getEntityClass()
    {
        return Users::class;
    }

    protected function getTableName()
    {
        return "users";
    }
}