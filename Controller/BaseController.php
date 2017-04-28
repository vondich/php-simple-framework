<?php
namespace Controller;

abstract class BaseController implements IController
{
    private $controllerName = 'main';
    private $hasOutput = true;
    private $appConfig;
    private $outputParams = array();
    private $layout = 'default';
    
    public function __construct($applicationConfig)
    {
        $this->appConfig = $applicationConfig;
    }
    
    public function displayOutput()
    {
        $layoutFilename = TEMPLATE_LOCATION . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . $this->layout . '.php';
        $appconfig = $this->appConfig;
        foreach($this->outputParams as $key => $val)
        {
            $key = $val;
        }
        
        ob_start();
        include(TEMPLATE_LOCATION . DIRECTORY_SEPARATOR . $this->controllerName . DIRECTORY_SEPARATOR . 'default.php');
        $content = ob_get_contents();
        ob_end_clean();
        
        ob_start();
        include($layoutFilename);
        $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
    }

    public function hasOutput()
    {
        return $this->hasOutput;
    }

    protected function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    abstract function process();
}
