<?php

namespace action\model;

use core\AbstractModel;

class BooksPageModel extends AbstractModel
{

    /**
     * Creates content and put it in an array
     *
     * @return array
     */
    protected function createContentArray(): array
    {
        // TODO: Implement createContentArray() method.
        return array(
            'content' => $this->getContent(),
            'pagination' => $this->getPagination()
        );
    }

    /**
     * Sets a query to the database;
     * the result is returned as content
     *
     * @return array
     */
    private function getContent(): array
    {
        $offset = $this->param;
        $contentArray = array();
        $command = (
            "SELECT b.book_id, b.book, GROUP_CONCAT(DISTINCT a.author ORDER BY a.author ASC) AS 'authors'" .
            "FROM `books` b JOIN relation USING(book_id) JOIN `authors` a USING(author_id) GROUP BY book_id"
            . " LIMIT " . $offset
        );
        $rows = $this->sql->runSqlCommand($command);
        while ($row = $rows->fetch()) {
            $contentArray[] = $row;
        }
        return $contentArray;
    }

    /**
     * The method processes and creates the pagination list for the page
     *
     * @return array
     */
    private function getPagination(): array
    {
        return array(
            'previous' => $this->linkPrevious($this->param),
            'next' => $this->linkNext($this->param, $this->sql->getBooksCount())
        );
    }

    /**
     * Returns the previous number of books
     *
     * @param $offset
     * @return int
     */
    private function linkPrevious($offset): int
    {
        $link = $offset - self::STEPS;
        return ($offset <= self::STEPS) ? 0 : $link;
    }

    /**
     * link expands the number of books
     *
     * @param $offset
     * @param $booksCount
     * @return int
     */
    private function linkNext($offset, $booksCount): int
    {
        return ($offset < $booksCount) ? ($offset + self::STEPS) : 0;
    }
}