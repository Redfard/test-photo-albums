<?php

namespace App;

use PDO;

class Database
{
    protected $serverName = 'localhost';
    protected $userName   = "root";
    protected $password   = "root";
    protected $dbName     = "test";
    protected $port       = '3306';

    protected static $instance;
    protected        $pdo;

    private function __construct()
    {
    }

    public static function getInstance(): object
    {
        if (! self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getPdo(): object
    {
        if ($this->pdo) {
            return $this->pdo;
        }

        $dsn = "mysql:host=$this->serverName;port=$this->port;dbname=$this->dbName;charset=utf8";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $pdo = new PDO($dsn, $this->userName, $this->password, $options);

        return $pdo;
    }
}