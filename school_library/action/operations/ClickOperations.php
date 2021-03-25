<?php

namespace action\operations;

use core\AbstractOperations;
use exception\InternalServerErrorException;


class ClickOperations extends AbstractOperations
{

    /**
     * Performs the desired operation and returns the answer
     * Handles errors
     * implement a click counter
     *
     * @throws InternalServerErrorException
     */
    protected function response()
    {
        // TODO: Implement isRequestProcessedSuccessfully() method.
        $command = "UPDATE books SET `clicks` = `clicks` + 1 WHERE `book_id`= " . $this->request;
        if (!$this->sql->runSqlCommand($command)) {
            throw new InternalServerErrorException();
        }
    }
}