<?php

require 'autoload.php';

$request = new \Request\GetAccount(array());
if(FALSE == $request->validate())
{
    header('Location: index.html');
}
else
{
    if(empty($_GET['id']))
    {
        header('Location: shop.php');
    }
    
    $requestData = array('id' => $_GET['id']);
    
    $response = $request->process();
    $request = new \Request\Buy($requestData);
    $buyResponse = $request->process();
    
    $error = '';
    if(isset($buyResponse['error']))
    {
        $error = $buyResponse['error'];
    }
    elseif(isset($buyResponse['status']) && $buyResponse['status'] == 'completed')
    {
        $request = new \Request\GetItems(array());
        $items = $request->process();
        $item_id = $_GET['id'];
        $item = NULL;
        if(array_key_exists($item_id, $items['items']))
        {
            $item = $items['items'][$item_id];
        }
        else
        {
            $error = 'Item not found!';
        }
        
        // refresh account balance
        $request = new \Request\GetAccount(array());
        $response = $request->process();
    }
    elseif(isset($buyResponse['status']) && isset($buyResponse['meta_data']))
    {
        $error = $buyResponse['meta_data']['error_message'];
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Shop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-3">
                     <div class="page-header">
                        <h1>My Shop</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-md-offset-3">
                    <a href="shop.php">Shop</a>
                </div>
                
                <div class="col-md-3">
                    <h2>Welcome!</h2>
                </div>
                
                <div class="col-md-2">
                    Balance: <?php echo $response['user_account']['available_balance']; ?> SGD
                </div>
            </div>
            <div id="dashboard" class="row">
                <div class="col-md-9 col-md-offset-3">
                    <?php if($error != ''): ?>
                    <div class="alert alert-warning"><?php echo $error ?></div>
                    <?php else: ?>
                        <h3>Purchased <?php echo $item['name'] ?>!</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>
