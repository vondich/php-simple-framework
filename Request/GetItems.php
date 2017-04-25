<?php
namespace Request;

class GetItems implements RequestI
{
    private $requestData;
    private $error;
    
    // TODO get from DB
    public static $items = array(
        100 => array(
            'name' => 'Kindle'
            , 'price' => '1.99'
            , 'image' => 'https://images-na.ssl-images-amazon.com/images/G/01/kindle/store/2016/eink/voyage_desktop_tile.jpg'
        )
        , 101 => array(
            'name' => 'Macbook'
            , 'price' => '199.99'
            , 'image' => 'https://cdn4.iconfinder.com/data/icons/MacBook_Pro/512/leopard.png'
        )
    );
    
    public function __construct($data)
    {
        $this->requestData = $data;
    }
    public function process()
    {
        return array('items' => self::$items);
    }

    public function validate()
    {
        return TRUE;
    }
    
    public function get_error()
    {
        return $this->error;
    }
}
