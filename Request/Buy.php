<?php
namespace Request;

class Buy implements RequestI
{
    private $requestData;
    private $error;
    
    public function __construct($data)
    {
        $this->requestData = $data;
    }
    public function process()
    {
        $item_id = $this->requestData['id'];
        
        $item = GetItems::$items[$item_id];
        $payment = new \Lib\PaymentWrapper();
        $user_account = $payment->getUserAccount($_SESSION['user_api_token']);
        
        $params = array(
            'amount' => $item['price']
            , 'order_id' => $this->requestData['id']
            , 'user_email' => $user_account['user_account']['email']
        );
        return $payment->charge($_SESSION['user_api_token'], $params);
    }

    public function validate()
    {
        session_start();
        if(empty($_SESSION['user_api_token']))
        {
            $this->error  = 'Invalid session';
            return FALSE;
        }
        
        if(FALSE === array_key_exists($this->requestData['id'], GetItems::$items))
        {
            $this->error  = 'Item not found!';
            return FALSE;
        }
        
        return TRUE;
    }
    
    public function get_error()
    {
        return $this->error;
    }
}
