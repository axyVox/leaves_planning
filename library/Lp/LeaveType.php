<?php

class Lp_LeaveType {

    public static function isPaid($type){
        $leave_type_model = new Model_LeaveType();
        $paid_type = $leave_type_model->getIdByName('paid');
        return $paid_type == $type;
    }

    public static function isNotPaid($type){
        $leave_type_model = new Model_LeaveType();
        $not_paid_type = $leave_type_model->getIdByName('not_paid');
        return $not_paid_type == $type;
    }

} 