<?php

namespace core;

/**
 * Class AbstractModel
 * Contains the basic functionality of all models.
 *
 * @package core
 */
abstract class AbstractModel implements ConstantInterface
{
    protected $param;
    protected $contentArray;
    protected $sql;

    /**
     * AbstractModel constructor.
     * accepts request parameters
     * connects a class for working with a database
     *
     * @param $param
     */
    public function __construct($param)
    {
        $this->sql = new DbClass();
        $this->param = $param;
    }

    /**
     * Starts processing the request while
     * creating the necessary content
     */
    public function run()
    {
        $this->contentArray = $this->createContentArray();
    }

    /**
     * Returns an array containing content
     *
     * @return array
     */
    public function getContentArray(): array
    {
        return $this->contentArray;
    }

    /**
     * Creates content and puts it in an associative array
     * uses request parameters
     *
     * @return array
     */
    abstract protected function createContentArray(): array;


}