<?php

class IndexController extends Bi_BaseController
{

    public function init()
    {
        /* Initialize action controller here */
        parent::init();
    }

    public function indexAction()
    {
        $this->view->translate = $this->translate;
        $this->view->sess_lang = $this->session->lang;
    }

    public function testAction()
    {
        $request = $this->getRequest();

        $this->view->post = $request->getParam('post','post_is_not_set');
        $this->view->mess = $request->getParam('mess','get_is_not_set');
    }

    public function setLanguageAction(){

        $lang = $this->getRequest()->getParam('lang');

//        $this->view->layout()->disableLayout();
//        $this->getHelper('viewRenderer')->setNoRender();

        $this->session->lang = $lang;

//        echo '<br>';
//        echo 'session: '.$this->session->lang;

        $this->redirect('/index');
    }

}

