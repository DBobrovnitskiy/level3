<?php

namespace action\model;

use core\AbstractModel;

class AdminPageModel extends AbstractModel
{
    /**
     * Creates content and put it in an array
     *
     * @return array
     */
    protected function createContentArray(): array
    {
        // TODO: Implement createContentArray() method.
        $books = $this->sql->getBooksCount();
        return array(
            'content' => $this->getContent($this->param),
            'page' => $this->param,
            'pages' => $this->getPagination($this->param, $books)
        );
    }

    /**
     * Sets a query to the database;
     * the result is returned as content
     *
     * @param $page
     * @return array
     */
    private function getContent($page): array
    {
        $books = self::BOOKS_ON_THE_PAGE;
        $contentArray = array();
        $command = (
            "SELECT b.clicks, b.book_id, b.is_delete, b.year, b.book, " .
            "GROUP_CONCAT(DISTINCT a.author ORDER BY a.author ASC) AS 'authors'" .
            "FROM `books` b JOIN relation USING(book_id) JOIN `authors` a USING(author_id) GROUP BY book_id" .
            " LIMIT " . $books . " OFFSET " . (($page - 1) * $books)
        );
        $rows = $this->sql->runSqlCommand($command);
        while ($row = $rows->fetch()) {
            $contentArray[] = $row;
        }
        return $contentArray;
    }

    /**
     * the method processes and creates the pagination list for the page
     *
     * @param $page
     * @param $books
     * @return int[]
     */
    private function getPagination($page, $books): array
    {
        $ps = self::PAGINATION_AREA;
        $pages = ceil((float)$books / self::BOOKS_ON_THE_PAGE);
        $pagesArray = array(1);
        for ($i = 2; $i < $pages; $i++) {
            if (($page - $i <= $ps && $page - $i >= 0) || ($i - $page <= $ps && $i - $page >= 0)) {
                $pagesArray[] = $i;
            }
        }
        if ($pages > 1) {
            $pagesArray[] = $pages;
        }
        return $pagesArray;
    }
}