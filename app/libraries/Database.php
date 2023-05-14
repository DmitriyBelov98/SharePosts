<?php

// подключение к БД, подготовка запросов
namespace libraries;
use PDO;

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;
    private $dbh;
    private $stmt;
    private $error;
    public function __construct(

    )
    {
        // SET DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Подготовка запроса

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // привязка значений

    public function bind(string $param, $value, $type = null)
    {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT ,
                is_bool($value) => PDO::PARAM_BOOL ,
                is_null($value) => PDO::PARAM_NULL ,
                default => PDO::PARAM_STR ,
            };

        }

       
            $this->stmt->bindValue($param, $value, $type);
        

    }

    // выполнение подготовленного запроса

    public function execute()
    {
        return $this->stmt->execute();
    }

    // получение данных с бд массивом объектов

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ); // получение в виде объекта
    }

    // получение одиночной записи как объект
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // получение количества строк

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

}
