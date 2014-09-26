<?php

class Lp_ApproveType
{

    public static function isApproved($type)
    {
        return $type == Zend_Registry::get('approved_request');
    }

    public static function isRejected($type)
    {
        return $type == Zend_Registry::get('rejected_request');
    }

    public static function isPending($type)
    {
        return $type == Zend_Registry::get('pending_request');
    }

} 