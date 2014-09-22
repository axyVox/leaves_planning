<?php
class Bi_BaseController extends Zend_Controller_Action {


    public function init(){

        Zend_Session::start();
        $this->session = new Zend_Session_Namespace('broker_interface');;
        $this->view->session	= $this->session;

        $locale = 'sr';

        if(isset($this->session->lang)){
            $locale = $this->session->lang;
        }

        $translate	= new Zend_Translate('gettext', APPLICATION_PATH.'/../localization/mo/' . $locale . '/content.mo',
                $locale);

        if($locale!='sr'){
            $translate->addTranslation(APPLICATION_PATH.'/../localization/mo/' . $locale . '/content.mo', $locale);
        }
        $translate->setLocale($locale);

        $this->translate	= $translate;
        $this->view->translate	= $translate;

    }

}