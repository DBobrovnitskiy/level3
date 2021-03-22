<?php

namespace action\controller;

use action\model\SearchPageModel;
use action\view\SearchPageView;
use core\AbstractController;
use core\AbstractModel;

class SearchController extends AbstractController
{

    /**
     * Connects the search model by
     * passing the page in the parameters
     *
     * @return AbstractModel
     */
    protected function getModel(): AbstractModel
    {
        // TODO: Implement getModel() method.
        if (!$this->isCorrectRequest()) {
            return new SearchPageModel(false);
        }
        return new SearchPageModel($_POST['search']);
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
        $view = new SearchPageView($model->getContentArray());
        $view->run();
        return $view->getPage();
    }

    /**
     * Checks the search query for correctness
     *
     * @return bool
     */
    private function isCorrectRequest(): bool
    {
        if (!isset($_POST['search'])) {
            return false;
        }
        return $this->validation();
    }

    /**
     * Validates the search query
     */
    private function validation(): bool
    {
        $_POST['search'] = trim($_POST['search']);
        $_POST['search'] = stripslashes($_POST['search']);
        $_POST['search'] = strip_tags($_POST['search']);
        if($_POST['search'] === ''){
            return false;
        }
        return (preg_replace("/[a-zA-Zа-яА-Я0-9 ієїё+\-№#$]{3,}/iu", '', $_POST['search']) === '');
    }
}
