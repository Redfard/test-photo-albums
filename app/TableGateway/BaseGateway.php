<?php

namespace App\TableGateway;

use App\Database;

abstract class BaseGateway {

    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }
}