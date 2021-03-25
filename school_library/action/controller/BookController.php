<?php

namespace action\controller;

use action\model\BookPageModel;
use action\view\BookPageView;
use core\AbstractController;
use core\AbstractModel;

class BookController extends AbstractController
{

    /**
     * Connects the book model by
     * passing the page in the parameters
     *
     * @return AbstractModel
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return new BookPageModel($this->request);
    }

    /**
     * Accepts the model, launches it for execution,
     * and transfers the result to the view
     * returns the resulting page
     *
     * @param $model
     * @return string
     */
    public function render($model): string
    {
        // TODO: Implement render() method.
        $view = new BookPageView($model->getContentArray());
        $view->run();
        return $view->getPage();
    }
}