<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {


    }

    public function testAction()
    {
        $request = $this->getRequest();

        $this->view->post = $request->getParam('post','post_is_not_set');
        $this->view->mess = $request->getParam('mess','get_is_not_set');
    }


}

