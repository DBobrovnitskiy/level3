<?php

namespace core;

/**
 * Class RouterClass
 * Connects the required controller class
 * or operations depending on the received request
 *
 * @package core
 */
class RouterClass implements ConstantInterface
{
    /**
     * Runs the class work
     * defines whether to start a controller or an operation
     */
    public function run()
    {
        if ($_SERVER['REQUEST_URI'] === '/operations') {
            $this->runOperations();
            exit();
        }
        $this->runController();
    }

    /**
     * Includes the desired operation class
     */
    private function runOperations()
    {
        $operationsName = 'action\\operations\\' . $_POST['operation'] . 'Operations';
        $operations = new $operationsName($_POST['arg']);
        $operations->run();
    }

    /**
     * It processes the request and starts a
     * controller selection process
     * requests an array of rules
     * if the controller does not start it
     * returns an error page
     */
    private function runController()
    {

        $urlArray = explode('/', $_SERVER['REQUEST_URI'], 4);
        $request = $urlArray[2] ?? false;
        $rulesArray = $this->getRulesArray();
        if (!$this->findAndRunController($rulesArray, $request)) {
            $this->returnError();
        }
    }

    /**
     * Goes through the array of rules comparing the received request
     * In cases of coincidence, connects and launches the
     * corresponding controller for execution
     * Returns true on success or false on failure
     *
     * @param $rulesArray
     * @param $request
     * @return bool
     */
    private function findAndRunController($rulesArray, $request): bool
    {
        foreach ($rulesArray as $rule) {
            if ($this->isRules($rule)) {
                $controller = 'action\\controller\\' . $rule['controller'];
                $controller = new $controller($request);
                $controller->run();
                return true;
            }
        }
        return false;
    }

    /**
     * Compares the request to the rule
     *
     * @param $rule
     * @return bool
     */
    private function isRules($rule): bool
    {
        return (
            $_SERVER['REQUEST_METHOD'] === $rule['method'] &&
            preg_replace($rule['pattern'], '', $_SERVER['REQUEST_URI']) === ''
        );
    }

    /**
     * Returns an error page
     */
    private function returnError()
    {
        include_once self::DIRECTORY . '/tpl/not_found.tpl';
    }

//======================================================================================================================

    /**
     * Contains an array of router rules
     *
     * @return string[][]
     */
    private function getRulesArray(): array
    {
        return array(
            array(
                'method' => 'GET',
                'pattern' => '/(\/book\/)[1-9][0-9]*\/?/',
                'controller' => 'BookController'
            ),
            array(
                'method' => 'GET',
                'pattern' => '/(\/books\/)[1-9][0-9]*\/?/',
                'controller' => 'BooksController'
            ),
            array(
                'method' => 'GET',
                'pattern' => '/\/(books)?\/?/',
                'controller' => 'BooksController'
            ),
            array(
                'method' => 'POST',
                'pattern' => '/(\/search)\/?/',
                'controller' => 'SearchController'
            ),
            array(
                'method' => 'GET',
                'pattern' => '/(\/admin)(\/[1-9][0-9]*)?\/?/',
                'controller' => 'AdminController'
            ),
        );
    }
}