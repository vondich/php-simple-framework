<?php

namespace Controller;

/**
 * Description of ControllerFactory
 *
 * @author nin
 */
class ControllerFactory
{
    /**
     * 
     * @param string $controllerName
     * @return \Controller\IController
     */
    public static function getController($controllerName, $applicationConfig)
    {
        $className = '\\Controller\\' . ucwords($controllerName) . 'Controller';
        return new $className($applicationConfig);
    }
}
