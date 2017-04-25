<?php
namespace Request;

class GetAccount implements RequestI
{
    private $requestData;
    private $error;
    
    public function __construct($data)
    {
        $this->requestData = $data;
    }
    public function process()
    {
        $payment = new \Lib\PaymentWrapper();
        
        return $payment->getUserAccount($_SESSION['user_api_token']);
    }

    public function validate()
    {
        session_start();
        if(empty($_SESSION['user_api_token']))
        {
            $this->error  = 'Invalid session';
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function get_error()
    {
        return $this->error;
    }
}
