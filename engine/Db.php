<?php

namespace app\engine;

use app\models\Model;
use app\traits\TSingletone;

class Db
{
    use TSingletone;

    private array $config = [
        'driver' => 'mysql',
        'host' => 'localhost:3307',
        'login' => 'root',
        'password' => '',
        'database' => 'onlytest',
        'charset' => 'utf8',
    ];

    private ?\PDO $connection = null;

    private function getConnection()

    {
        if (is_null($this->connection)) {
            //PDO вместо mysqli_connect()
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);
            //режим извлечения данных по умолчанию - ассоциативный массив
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    //соберем строку подключения к PDO из конфига
    private function prepareDsnString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
        );
    }

    //выполнение любого запроса
    //SELECT * FROM users WHERE id= :id
    //params = ['id' => 1]
    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
//        $STH->bindValue(':id', 2, \PDO::PARAM_INT );
        $STH->execute($params);
        return $STH;
    }



    //Кастомный запрос для LIMIT PARAM_INT
    private function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, \PDO::PARAM_INT );
        $STH->execute();
        return $STH;
    }

    public function queryAllLimit($sql, $params = [])    {

        return $this->queryLimit($sql, $params)->fetchAll();
    }


    //WHERE id=1
    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    //Запрос вернет объект
    public function queryOneObject($sql, $params, $class)
    {
        $STH = $this->query($sql, $params);
        //изменить режим
        $STH->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, $class);
        return $STH->fetch();

    }


    //SELECT *
    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(); //вернет двумерный массив
    }

    //INSERT, UPDATE, DELETE
    public function execute($sql, $params = []): int
    {
        var_dump($sql, $params);
        return $this->query($sql, $params)->rowCount(); //вернем количество затронутых данных
    }

    public function lastInsertID(){
        return $this->connection->lastInsertID();
    }

}