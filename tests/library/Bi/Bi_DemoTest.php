<?php

class Bi_DemoTest
    extends ControllerTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function  testDemoClass(){
        $f = new Bi_Demo();
        $demo_name = $f->getName();
        $this->assertEquals('Demo Name', $demo_name);
    }

}


