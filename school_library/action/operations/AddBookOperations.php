<?php

namespace action\operations;

use core\AbstractOperations;
use exception\BadRequestException;
use exception\InternalServerErrorException;

class AddBookOperations extends AbstractOperations
{

    /**
     * Performs the desired operation and display the answer
     * Adds a new book to the database, also adds new authors,
     * provided that they are not yet present in the database
     *
     * @throws BadRequestException
     * @throws InternalServerErrorException
     */
    protected function response(): void
    {
        // TODO: Implement isRequestProcessedSuccessfully() method.
        $this->massage = ValidationsFormClass::validation();
        if ($this->massage === '') {
            $this->addBook();
            return;
        }
        throw new BadRequestException();
    }

    /**
     * Adds book, authors, and book cover to the database
     *
     * @throws InternalServerErrorException
     */
    private function addBook(): void
    {
        $bookID = $this->addNewBook();
        $this->addImage($bookID);
        $this->createARelationshipWithTheAuthor($bookID);
    }

    /**
     * Adds a book to the database,
     * and returns the id of the added book
     *
     * @return int
     * @throws InternalServerErrorException
     */
    private function addNewBook(): int
    {
        $command = "INSERT INTO `books` (`book_id`, `book`, `pages`, `year`, `about`, `is_delete`, `views`, `clicks`)" .
            " VALUES (NULL, ?, NULL, ?, ?, '0', '0', '0') ";
        $bindParam = array($_POST['book'], $_POST['year'], $_POST['about']);
        if ($this->sql->runSqlCommand($command, $bindParam) === false) {
            throw new InternalServerErrorException();
        }
        return $this->sql->getLastInsertID();
    }

    /**
     * Creates relationship between book and authors,
     * and writes them to the database
     *
     * @param int $bookID
     * @throws InternalServerErrorException
     */
    private function createARelationshipWithTheAuthor(int $bookID): void
    {
        $authorsId = $this->getAuthorsId();
        foreach ($authorsId as $author) {
            $command = "INSERT INTO `relation` (`book_id`, `author_id`) VALUES (?, ?)";
            if (!$this->sql->runSqlCommand($command, [$bookID, $author])) {
                throw new InternalServerErrorException();
            }
        }
    }

    /**
     * Queries the database to get author IDs, then returns them as an array.
     * If there are no authors in the database. then first they are added there
     *
     * @return array
     */
    private function getAuthorsId(): array
    {
        $arrayReturn = array();
        foreach ($_POST['authors'] as $author) {
            if ($author === '') {
                continue;
            }
            $command = "INSERT INTO `authors` (`author_id`, `author`) VALUES (NULL, ?)";
            $this->sql->runSqlCommand($command, [$author]);
        }
        $command = "SELECT author_id FROM `authors` WHERE `author` LIKE ? OR `author` LIKE ? OR `author` LIKE ? ";
        $prepare = $this->sql->runSqlCommand($command, $_POST['authors']);
        while ($row = $prepare->fetch()) {
            $arrayReturn[] = $row[0];
        }
        return $arrayReturn;
    }

    /**
     * Adds a cover image of a new book
     *
     * @param $bookID
     */
    private function addImage($bookID): void
    {
        if (!isset($_FILES[0])) {
            return;
        }
        $image = imagecreatefromstring(file_get_contents($_FILES[0]['tmp_name']));
        imagejpeg($image, self::DIRECTORY . "/image/$bookID.jpg", 100);
    }


}