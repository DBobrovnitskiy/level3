<?php

namespace action\view;

use core\AbstractView;

/**
 * Class BookPageView
 * From the data received from the model creates the "book" page
 *
 * @package action\view
 */
class BookPageView extends AbstractView
{
    /**
     * Creates the "book" page and returns it as a string
     *
     * @return string
     */
    protected function createPage(): string
    {
        // TODO: Implement createPage() method.
        ob_start();
        $header = self::getTpl('header');
        $footer = self::getTpl('footer');
        $id = $this->contentArray['book_id'];
        $book = $this->contentArray['book'];
        $authors = $this->contentArray['authors'];
        $pages = $this->contentArray['pages'];
        $year = $this->contentArray['year'];
        $about = $this->contentArray['about'];
        include self::DIRECTORY .  '/tpl/book.tpl';
        return ob_get_clean();
    }
}