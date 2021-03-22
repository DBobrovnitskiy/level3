<?php

namespace core;


use exception\BadRequestException;
use exception\InternalServerErrorException;
use PDOException;

/**
 * Class AbstractOperations
 * Contains the basic functionality of all operations.
 *
 * @package core
 */
abstract class AbstractOperations implements ConstantInterface
{
    protected $massage;
    protected $request;
    protected $sql;

    /**
     * AbstractOperations constructor.
     * accepts request parameters
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Performs the desired operation and returns the answer
     * Handles errors
     */
    public function run(): void
    {
        try {
            $this->sql = new DbClass();
            $this->response();
            echo '{"ok": true}';
        } catch (PDOException | InternalServerErrorException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo '{"ok": "false"}';
        } catch (BadRequestException $e) {
            header('HTTP/1.1 401 Bad Request');
            echo $this->massage;
        }
    }

    /**
     * Performs the desired operation and display the answer
     */
    abstract protected function response(): void;


}