<?php

class IndexController extends Lp_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        $this->view->layout()->setLayout('offline');
        $this->redirectByUserRole();

        $request = $this->getRequest();

        if($request->isPost()){
            $username =  $request->getParam('username');
            $password =  $request->getParam('password');

            $result = $this->login($username, $password);
            if($result->isValid()){
                $this->redirectByUserRole();
            }else{
                $this->logout();
                $this->view->message = 'Korisničko ime ili lozinka nisu ispravni';
                return false;
            }
        }
    }


    protected function getAuthAdapter(){
        $auth_adapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $auth_adapter->setTableName('users');
        $auth_adapter->setIdentityColumn('username');
        $auth_adapter->setCredentialColumn('password');
        return $auth_adapter;
    }

}

