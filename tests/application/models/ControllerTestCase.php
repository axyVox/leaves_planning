<?php


class ControllerTestCase
    extends PHPUnit_Framework_TestCase
{
    /**
     * @var Zend_Application
     */
    protected $application;

    public function setUp(){
        $this->bootstrap = array($this, 'appBootstrap');
        parent::setUp();
    }

    public function appBootstrap(){
        $this->application = new Zend_Application(APPLICATION_ENV,
                                                    APPLICATION_PATH.'/configs/application.ini');
    }

} 