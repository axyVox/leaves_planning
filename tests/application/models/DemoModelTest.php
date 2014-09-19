<?php

class Model_DemoModelTest
    extends ControllerTestCase
{
    public function setUp()
    {
        Autoload::model('DemoModel');
        parent::setUp();
    }

    public function  testDemo(){
        $demo_model = new Model_DemoModel();
        $info = $demo_model->getInfo();

        $this->assertEquals('Demo model class.',$info);
    }


} 