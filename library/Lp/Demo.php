<?php

class Lp_Demo {

    private $_name;

    public function __construct(){
        $this->_name = "Demo Name";
    }

    public function getName(){
        return $this->_name;
    }

} 