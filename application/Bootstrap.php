<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoLoad()
    {
        $auto_loader = Zend_Loader_Autoloader::getInstance();
        $resource_loader = new Zend_Loader_Autoloader_Resource(
            array(
                'basePath' => APPLICATION_PATH,
                'namespace' => '',
                'resourceTypes' => array(
                    'model' => array(
                        'path' => 'models/',
                        'namespace' => 'Model_'
                    )
                ),
            )
        );
        return $resource_loader;

    }

    /**
     * init database adapter
     */
    protected function _initDatabase()
    {
        // get config from config/application.ini
        $config = $this->getOptions();

        $db = Zend_Db::factory($config['database']['adapter'], $config['database']['params']);

        //set default adapter
        Zend_Db_Table::setDefaultAdapter($db);

        //save Db in registry for later use
        Zend_Registry::set("db", $db);
    }

    /**
     * Add jquery zend helper - It;s in test version but still good enough
     */
    protected function _initJquery()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->addHelperPath(
            "ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper"
        );

        Zend_Controller_Action_HelperBroker::addHelper(
            new ZendX_JQuery_Controller_Action_Helper_AutoComplete()
        );

    }

    protected function _initConfigs()
    {
        /**
         * Set variables from config files to zend registry
         */
        $this->bootstrap('LocalConfigs');
        $registry = $this->getResource('LocalConfigs');
        foreach ($registry as $key => $value) {
            Zend_Registry::set($key, $value);
        }
        Zend_Registry::set('http_user_agent', $_SERVER['HTTP_USER_AGENT']);

    }

    protected function _initLocalConfigs()
    {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/config.ini');
        // store it into the registry
        $registry = new Zend_Registry($config->toArray(), ArrayObject::ARRAY_AS_PROPS);
        return $registry;

    }

}

