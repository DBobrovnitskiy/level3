<?php

namespace action\operations;

use core\AbstractOperations;
use exception\InternalServerErrorException;

class DeleteOperations extends AbstractOperations
{
    /**
     * Performs the desired operation and returns the answer
     * Handles errors
     * Adds the book to remove
     * or vice versa deletes a book removal
     *
     * @throws InternalServerErrorException
     */
    protected function response()
    {
        // TODO: Implement isRequestProcessedSuccessfully() method.
        $command = "UPDATE books SET `is_delete` = (`is_delete` = 0) WHERE `book_id`= " . $this->request;
        if (!$this->sql->runSqlCommand($command)) {
            throw new InternalServerErrorException();
        }
    }
}