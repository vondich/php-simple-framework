<?php

if (! function_exists('_autoload'))
{
    function _autoload($class)
    {
        $fileName = NULL;
        $fileName = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        
        if (file_exists($fileName))
        {
            require $fileName;
        }
    }
}

spl_autoload_register('_autoload');

// require_once('vendor/autoload.php');

define('TEMPLATE_LOCATION', __DIR__ . DIRECTORY_SEPARATOR . 'Views');
define('DEFAULT_CONTROLLER', 'main');

$controller_name = \Lib\Utils::arrayValue($_GET, 'controller', DEFAULT_CONTROLLER);
if(!$controller_name)
{
    header("HTTP/1.0 404 Not Found");
    exit;
}

try
{
    //TODO load application config
    $application_config = array('application_name' => 'My App');
    
    $controller = \Controller\ControllerFactory::getController($controller_name, $application_config);
    $controller->process();
    if($controller->hasOutput())
    {
        echo $controller->displayOutput();
    }
}
catch (Exception $ex)
{
    // TODO log error
    header("HTTP/1.0 500 Internal Server Error");
}


