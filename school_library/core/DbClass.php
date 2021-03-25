<?php

namespace core;

use PDO;

/**
 * Class DbClass
 * Contains the basic methods for working with the database
 * necessary for the functioning of the resource
 *
 * @package core
 */
class DbClass
{
    const HOST = '.....';
    const DB = '.....';
    const USER = '.....';
    const PASS = '......';

    private $pdo;

    /**
     * DbClass constructor.
     * Connects to the database
     */
    public function __construct()
    {
        $this->pdo = $this->getPdo();
    }

    /**
     * Generic class that executes both prepared
     * and unprepared statement commands
     *
     * @param $command
     * @param array $bindParam - array of request variables
     * @return false|\PDOStatement
     */
    public function runSqlCommand($command, $bindParam = [])
    {
        $prepare = $this->pdo->prepare($command);
        if ($prepare->execute($bindParam)) {
            return $prepare;
        }
        return false;
    }

    /**
     * Returns the id of the last request
     *
     * @return string
     */
    public function getLastInsertID(): string
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Returns the number of books in the library
     *
     * @return int
     */
    public function getBooksCount(): int
    {
        $select = $this->runSqlCommand('SELECT COUNT(*) FROM ' . 'books');
        $count = $select->fetch();
        return $count[0];
    }

    public function getError()
    {
        print_r(print_r($this->pdo->errorInfo()));
    }

    /**
     * Creates a connection to the database
     *
     * @return PDO
     */
    private function getPdo(): PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB . ';charset=utf8';
        return new PDO($dsn, self::USER, self::PASS);
    }
}