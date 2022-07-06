<?php

namespace BookStore;

use PDO;
use PDOStatement;

class PDOConnection
{
    private string $host = 'localhost';
    private string $user = 'root';
    private string $password = 'password';
    private string $dbname = 'BookStore';
    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct()
    {
        // set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $this->pdo = new PDO($dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }

    public function prepareStatement(string $sql)
    {
        $this->statement = $this->pdo->prepare($sql);
    }

    public function executePDO(array $arguments = null): bool
    {
        return $this->statement->execute($arguments);
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }
}