<?php
namespace Request;

class Login implements RequestI
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
        $response = $pamyment->login($this->requestData['phone'], $this->requestData['otp']);
        $response['phone'] = $this->requestData['phone'];
        
        if(!empty($response['msg']) && $response['msg'] == 'success')
        {
            session_start();
            // TODO: save user_api_token in DB
            $_SESSION['user_api_token'] = $response['user_api_token'];
        }
        
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
