<?php

class IndexControllerTest
    extends ControllerTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function  testIndexAction(){
        $this->assertTrue(true);

        $client = new Zend_Http_Client("http://wikipedia.org");
        $response = $client->request();

        $body =  $response->getBody();

        //Make
        //Autoload::library('DemoModel');
        //Autoload::class('DemoModel');
        //...

        $f = new Bi_Demo();
        $demo_name = $f->getName();
        $this->assertEquals('Demo Name', $demo_name);

//        $this->request->setMethod('POST');

        /*$this->dispatch('/index');
        $this->assertAction("index");
        $this->assertController("index");*/
    }

}


