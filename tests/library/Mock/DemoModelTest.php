<?php

class Mock_DemoModelTest extends ControllerTestCase{

    public function testMockDemoModel(){
        $m = new Mock_DemoModel();
        $info = $m->getInfo();
        $this->assertEquals('Mock - Demo model class.', $info);
    }

} 