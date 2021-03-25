<?php

namespace action\controller;

use action\model\AdminPageModel;
use action\view\AdminPageView;
use core\AbstractController;
use core\AbstractModel;

class AdminController extends AbstractController
{
    /**
     * Connects the admin model by
     * passing the page in the parameters
     *
     * @return AbstractModel
     */
    protected function getModel(): AbstractModel
    {
        // TODO: Implement getModel() method.
        $this->login();
        if ($this->request == false) {
            $this->request = 1;
        }
        return new AdminPageModel($this->request);
    }

    /**
     * Accepts the model, launches it for execution,
     * and transfers the result to the view
     * returns the resulting page
     *
     * @param $model
     * @return string
     */
    protected function render($model): string
    {
        // TODO: Implement render() method.
        $view = new AdminPageView($model->getContentArray());
        $view->run();
        return $view->getPage();
    }

    /**
     * Checks if the page is available for the given user in
     * case of unavailability and prompts to enter the account
     */
    private function login()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !$this->isAdmin()) {
            header('WWW-Authenticate: Basic realm="My Realm"');
            header('HTTP/1.0 401 Unauthorized');
            exit;
        }
    }

    /**
     * Contains a list of available users
     *
     * @return bool
     */
    private function isAdmin(): bool
    {
        $login = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];
        return (
            ($login === '123' && $pass === '123') ||
            ($login === 'admin' && $pass === 'admin') ||
            ($login === 'root' && $pass === 'root')
        );
    }
}