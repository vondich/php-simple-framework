<?php

require 'autoload.php';

if(!$_POST)
{
    echo 'Invalid request';
    exit;
}

$action = $_POST['req'];
$requestData = $_POST;

$requestClass = '\\Request\\'.ucfirst($action);

/* @var $request \Request\RequestI */
$request = new $requestClass($requestData);
if(FALSE == $request->validate())
{
    $response = array('error' => $request->get_error());
}
else
{
    $response = $request->process();
}

echo json_encode($response);

