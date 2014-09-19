<?php
/*error_reporting(E_ALL | E_STRICT);

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

// Zend_Application
require_once 'Zend/Application.php';

//require_once 'controllers/--ControllerTestCase.php';
require_once 'ControllerTestCase.php';*/


error_reporting( E_ALL | E_STRICT );

define('BASE_PATH', realpath(dirname(__FILE__) . '/../../'));
define('APPLICATION_PATH', BASE_PATH . '/application');


// Include path
set_include_path(
    '.'
    . PATH_SEPARATOR . BASE_PATH . '/library'
    . PATH_SEPARATOR . get_include_path()
);

// Define application environment
define('APPLICATION_ENV', 'testing');

// Zend_Application
require_once 'Zend/Application.php';

// Create application, bootstrap, and run

require_once 'ControllerTestCase.php';