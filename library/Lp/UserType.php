<?php

class Lp_UserType {

    public static function isAdmin($type){
        $user_type_model = new Model_UserType();
        $admin_type = $user_type_model->getIdByName('admin');
        return $admin_type == $type;
    }

    public static function isUser($type){
        $user_type_model = new Model_UserType();
        $user_type = $user_type_model->getIdByName('user');
        return $user_type == $type;
    }

} 