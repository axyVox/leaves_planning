<?php

class Autoload {

    public static function model($name){
        require_once BASE_PATH . '/application/models/'.$name.'.php';
    }

} 