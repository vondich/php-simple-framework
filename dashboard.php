<?php

require 'autoload.php';

$request = new \Request\GetAccount(array());
if(FALSE == $request->validate())
{
    header('Location: index.html');
}
else
{
    $response = $request->process();
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
                    <div class="col-md-9">
                        <p>You have successfully created your Wallet.</p>
                        <p>You can top up your wallet by transferring to the following bank</p>
                        <p><strong>Bank Name:</strong> <?php echo $response['transfer_info']['bank_name_full'] ?></p>
                        <p><strong>Account Number:</strong> <?php echo $response['transfer_info']['bank_account_no'] ?></p>
                        <p><strong>Unique ID:</strong> <?php echo $response['transfer_info']['unique_id'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
