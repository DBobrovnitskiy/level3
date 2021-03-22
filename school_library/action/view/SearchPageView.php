<?php

namespace action\view;

use core\AbstractView;

/**
 * Class SearchPageView
 * From the data received from the model creates the "search" page
 *
 * @package action\view
 */
class SearchPageView extends AbstractView
{

    /**
     * Creates the "search" page and returns it as a string
     *
     * @return string
     */
    protected function createPage(): string
    {
        // TODO: Implement createPage() method.
        ob_start();
        $header = self::getTpl('header');
        $footer = self::getTpl('footer');
        $content = $this->getContent($this->contentArray['massage'], $this->contentArray['content']);
        include(self::DIRECTORY . '/tpl/books.tpl');
        return ob_get_clean();
    }

    /**
     * Adds books to the "search" page
     *
     * @param $stringMassage
     * @param $contentArray
     * @return string
     */
    private function getContent($stringMassage, $contentArray): string
    {
        ob_start();
        echo $this->getMassage($stringMassage);
        foreach ($contentArray as $booksParam) {
            $id = $booksParam['book_id'];
            $book = $booksParam['book'];
            $authors = $booksParam['authors'];
            include(self::DIRECTORY . '/tpl/one_book.tpl');
        }
        return ob_get_clean();
    }

    /**
     * Adds a message based on search results
     *
     * @param $stringMassage
     * @return string
     */
    private function getMassage($stringMassage): string
    {
        return '<div data-book-title="<?=$nameBook?>" class="title size_text">' . $stringMassage . '</div>';
    }
}