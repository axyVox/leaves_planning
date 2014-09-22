<?php

class IndexControllerTest
    extends ControllerTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function  testTestNoParamsAction(){
        $link = BASE_LINK.'/index/test/';
        $client = new Zend_Http_Client($link);
        $body =  $client->request()->getBody();

        $this->assertContains("get_is_not_set", $body);
        $this->assertContains("post_is_not_set", $body);
    }

    public function  testTestWithParamsAction(){
        $link = BASE_LINK.'/index/test/?mess=mess';
        $client = new Zend_Http_Client($link);
        $client->setMethod(Zend_Http_Client::POST);
        $client->setParameterPost("post","post");
        $body =  $client->request()->getBody();

        $this->assertContains("mess", $body);
        $this->assertContains("post", $body);
    }

}


