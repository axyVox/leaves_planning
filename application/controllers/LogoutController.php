<?php

class LogoutController
    extends Lp_Controller_Base
{
    public function indexAction(){
        $this->logout();
        $this->redirect('index');
    }

}

