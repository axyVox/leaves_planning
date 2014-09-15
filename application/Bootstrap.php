<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * init database adapter
     */
    protected function _initDatabase ()
    {
        $resource = $this->getPluginResource('multidb');
        $resource->init();

        Zend_Registry::set('fun_vas', $resource->getDb('fun_vas'));
        Zend_Registry::set('fun_bulk', $resource->getDb('fun_bulk'));
    }
}



