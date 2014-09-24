<?php
class Lp_Controller_Base extends Zend_Controller_Action {


    public function init(){
        parent::init();
    }

    public function checkIdentity(){
        if(Zend_Auth::getInstance()->hasIdentity()){
            $storage = Zend_Auth::getInstance()->getStorage()->read();

            if($storage->user_type == 1)
                $this->redirect('admin');

            if($storage->user_type == 2)
                $this->redirect('user');

        }
    }

    public function hasIdentity(){
        return Zend_Auth::getInstance()->hasIdentity();
    }

    public function isAdmin(){
        if(Zend_Auth::getInstance()->hasIdentity()){
            $storage = Zend_Auth::getInstance()->getStorage()->read();
            if($storage->user_type == 1)
                return true;

            return false;
        }
    }

    public function isUser(){
        if(Zend_Auth::getInstance()->hasIdentity()){
            $storage = Zend_Auth::getInstance()->getStorage()->read();
            if($storage->user_type == 2)
                return true;

            return false;
        }
    }


    public function redirectByUserRole(){
        if($this->hasIdentity()){
            if($this->isAdmin())
                $this->redirect('admin');

            if($this->isUser())
                $this->redirect('user');
        }
    }

    public function getUserStorage(){
        if(Zend_Auth::getInstance()->hasIdentity()){
            $storage = Zend_Auth::getInstance()->getStorage()->read();
            return $storage;
        }
    }

    /**
     * @param $username
     * @param $password
     * @return Zend_Auth_Result
     */
    public function login($username, $password)
    {
        $adapter = $this->getAuthAdapter();
        $adapter->setIdentity($username);
        $adapter->setCredential($password);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);

        $authstorage = $auth->getStorage();
        $userinfo = $adapter->getResultRowObject(null, 'login');
        $authstorage->write($userinfo);
        return $result;
    }

    public function logout(){
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy(true);
    }
}