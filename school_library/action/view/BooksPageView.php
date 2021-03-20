<?php
namespace action\view;

use core\AbstractView;

/**
 * Class BooksPageView
 * From the data received from the model creates the "books" page
 *
 * @package action\view
 */
class BooksPageView extends AbstractView
{

    /**
     * Creates the "books" page and returns it as a string
     *
     * @return string
     */
    protected function createPage(): string
    {
        // TODO: Implement createPage() method.
        ob_start();
        $header = self::getTpl('header');
        $footer = self::getTpl('footer');
        $content = $this->getContent($this->contentArray['content']);
        $pagination = $this->getPagination($this->contentArray['pagination']);
        include self::DIRECTORY . '/tpl/books.tpl';
        return ob_get_clean();
    }

    /**
     * Adds books to the "books" page
     *
     * @param $content
     * @return string
     */
    private function getContent($content):string
    {
        ob_start();
        foreach ($content as $booksParam) {
            $id = $booksParam['book_id'];
            $book = $booksParam['book'];
            $authors = $booksParam['authors'];
            include (self::DIRECTORY . '/tpl/one_book.tpl');
        }
        return ob_get_clean();
    }

    /**
     * Adds pagination to the "books" page
     *
     * @param $pagination
     * @return string
     */
    private function getPagination($pagination):string
    {
        $stringToReturn = '';
        if($pagination['previous'] !== 0){
            $stringToReturn .= $this->paginationItem($pagination['previous'],'Previous');
        }
        if($pagination['next'] !== 0){
            $stringToReturn .= $this->paginationItem($pagination['next'],'Next');
        }
        return $stringToReturn;
    }

    /**
     * Creates a pagination button
     *
     * @param $page
     * @param $string
     * @return string
     */
    private function paginationItem($page, $string): string
    {
        $link = self::HOST . '/books/' . $page;
        return ('<a href="'. $link . '" class="btn btn-success">' . $string . '</a>');
    }
}