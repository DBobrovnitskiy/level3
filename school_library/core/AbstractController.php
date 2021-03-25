<?php

namespace core;

use exception\NotFoundException;
use PDOException;

/**
 * Class AbstractController
 * Contains the basic functionality of all controllers.
 * Contains two abstract methods, which will allow any controller to work.
 *
 * @package core
 */
abstract class AbstractController implements ConstantInterface
{
    protected $request;

    /**
     * AbstractController constructor.
     * takes only one argument - request
     *
     * @param false $request
     */
    public function __construct($request = false)
    {
        $this->request = $request;
    }

    /**
     * Connects the desired model
     * launches it for execution
     * connects view
     * passes the result of the model execution there
     * launches execution view
     * displays the page
     */
    public function run()
    {
        // TODO: Implement run() method.
        try {
            $model = $this->getModel();
            $model->run();
            echo $this->render($model);
        } catch (PDOException $e) {
            header('HTTP/1.1 500 Internal Server Error');
            include_once self::DIRECTORY . '/tpl/internal_server_error.tpl';
        } catch (NotFoundException $e) {
            header('HTTP/1.1 404 Not Found');
            include_once self::DIRECTORY . '/tpl/not_found.tpl';
        }
    }

    /**
     * Connects the desired model
     *
     * @return AbstractModel
     */
    abstract protected function getModel();

    /**
     * Connects view
     * passes the result of the model execution there
     * launches execution view
     * displays the page
     *
     * @param $model
     * @return string
     */
    abstract protected function render($model): string;
}