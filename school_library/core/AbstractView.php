<?php

namespace core;

/**
 * Class AbstractView
 * Contains the basic functionality of all views.
 *
 * @package core
 */
abstract class AbstractView implements ConstantInterface
{
    protected $contentArray;
    protected $page;

    /**
     * AbstractView constructor.
     * takes an array with content
     *
     * @param $contentArray
     */
    public function __construct($contentArray)
    {
        $this->contentArray = $contentArray;
    }

    /**
     * Runs the class
     */
    public function run()
    {
        $this->page = $this->createPage();
    }

    /**
     * Creates a page using an array of content
     *
     * @return string
     */
    abstract protected function createPage(): string;

    /**
     * Returns the page
     *
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * Includes files from tpl directory
     *
     * @param $file - file name
     * @return string
     */
    protected static function getTpl($file): string
    {
        $fileLocation = self::DIRECTORY . '/tpl/' . $file . '.tpl';
        ob_start();
        include_once($fileLocation);
        return ob_get_clean();
    }

}