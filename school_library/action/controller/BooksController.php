<?php
namespace action\controller;


use action\model\BooksPageModel;
use action\view\BooksPageView;
use core\AbstractController;
use core\AbstractModel;

class BooksController extends AbstractController
{

    /**
     * Connects the books model by
     * passing the page in the parameters
     *
     * @return AbstractModel
     */
    public function getModel():AbstractModel
    {
        // TODO: Implement getModel() method.
        if($this->request == false){
            $this->request = 5;
        }
        return new BooksPageModel($this->request);
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
        $view = new BooksPageView($model->getContentArray());
        $view->run();
        return $view->getPage();
    }
}