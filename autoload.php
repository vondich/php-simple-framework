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
