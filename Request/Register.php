<?php
namespace Request;

class Register implements RequestI
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
        $response = $payment->getMockOtp($this->requestData['phone']);
        $response['phone'] = $this->requestData['phone'];
        return $response;
    }

    public function validate()
    {
        if(empty($this->requestData['phone']))
        {
            $this->error = 'Invalid phone number';
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function get_error()
    {
        return $this->error;
    }
}
