<?php
namespace action\model;

use core\AbstractModel;
use exception\NotFoundException;

class BookPageModel extends AbstractModel
{

    /**
     * Sets a query to the database;
     * the result is returned as content
     *
     * @return array
     * @throws NotFoundException
     */
    protected function createContentArray(): array
    {
        // TODO: Implement createContentArray() method.
        $command = (
            "SELECT b.book_id, b.book, b.year, b.pages, b.about, GROUP_CONCAT(DISTINCT a.author ORDER BY a.author ASC)" .
            " AS 'authors' FROM `books` b JOIN relation USING(book_id) JOIN `authors` a USING(author_id) " .
            "WHERE book_id LIKE '%" . $this->param . "%'"
        );
        $select = $this->sql->runSqlCommand($command);
        $contentArray = $select->fetch();
        if ($contentArray['book'] == false) {
            throw new NotFoundException();
        }
        $this->viewCounter();
        return $contentArray;
    }

    /**
     * Page view counter
     */
    private function viewCounter(): void
    {
        $command = "UPDATE books SET `views` = `views` + 1 WHERE `book_id`= ". $this->param ;
        $select = $this->sql->runSqlCommand($command);
    }
}