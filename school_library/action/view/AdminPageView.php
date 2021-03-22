<?php

namespace action\view;

use core\AbstractView;

/**
 * Class AdminPageView
 * From the data received from the model creates the "admin" page
 *
 * @package action\view
 */
class AdminPageView extends AbstractView
{

    /**
     * Creates the "admin" page and returns it as a string
     *
     * @return string
     */
    protected function createPage(): string
    {
        // TODO: Implement createPage() method.
        ob_start();
        $itemsBooks = $this->getItemsBook($this->contentArray['content']);
        $pagination = $this->getPagination($this->contentArray['page'], $this->contentArray['pages']);
        include (self::DIRECTORY . '/tpl/admin.tpl');
        return ob_get_clean();
    }

    /**
     * Adds books to the admin page
     *
     * @param $contentArray
     * @return string
     */
    private function getItemsBook($contentArray): string
    {
        ob_start();
        foreach ($contentArray as $bookItem) {
            $click = $bookItem['clicks'];
            $id = $bookItem['book_id'];
            $book = $bookItem['book'];
            $authors = $bookItem['authors'];
            $year = $bookItem['year'];
            $button = $this->getButton($bookItem['is_delete'], $id);
            include self::DIRECTORY . '/tpl/itemBook.tpl';
        }
        return ob_get_clean();
    }

    /**
     * Adds pagination to the admin page
     *
     * @param $page - current page
     * @param $pagesArray - pages present in pagination
     * @return string
     */
    private function getPagination($page, $pagesArray): string
    {
        $pagination = '<li class="page-item disabled"><a class="page-link"> Pages: </a></li>';
        foreach ($pagesArray as $item) {
            $pagination .= $this->paginationItem($item, $page);
        }
        return $pagination;
    }

    /**
     * Creates one pagination cell
     *
     * @param $item - new cell
     * @param $page - current page
     * @return string
     */
    private function paginationItem($item, $page): string
    {
        $active = $page == $item ? ' disabled' : '';
        $link = self::HOST . '/admin/' . $item;
        return ('<li class="page-item' . $active . '"><a class="page-link" href="' . $link . '">' . $item . '</a></li>');
    }

    /**
     * Adds a delete button to a cell in the book
     *
     * @param $isDelete
     * @param $id
     * @return string
     */
    private function getButton($isDelete, $id): string
    {
        ob_start();
        $massage = !$isDelete ? 'Удалить' : 'Отменить';
        $color = !$isDelete ? 'danger' : 'success';
        include self::DIRECTORY .  '/tpl/button.tpl';
        return ob_get_clean();
    }
}