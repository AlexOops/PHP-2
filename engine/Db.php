<?php

namespace app\engine;

use app\traits\TSingleton;

class Db
{
    use TSingleton;

    // Db стал Singleton

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'boats',
        'charset' => 'utf8',
    ];

    private $connection = null; //объект PDO

    private function getConnection() // проверка на создание подключения
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDnsString(),
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            // режим извлечение данных по умолч в виде ассоциативного массива
        }
        return $this->connection;
    }

    private function prepareDnsString() //минирендер - извлечение из config[] в строку для getConnection
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    // подготовка любого запроса. params = where id = 1
    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }

    //limit
    public function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, \PDO::PARAM_INT); //тип, чтобы убрать кавычки
        $STH->execute();
        return $STH;
    }

    //1
    public function queryOne($sql, $params = []) // принимает из модели и вызывает query
    {
        return $this->query($sql, $params)->fetch(); // fetch вернет данные в ввиде ассоциативного массива
    }

    //obj
    public function queryOneObject($sql, $params, $class)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $STH->fetch();
    }

    //all
    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(); // вернет двумерный(ключ => значение) массив
    }

    public function execute($sql, $params = [])
    {
        var_dump($sql, $params);
        return $this->query($sql, $params)->rowCount(); // вернет число затронутых строк
    }
}