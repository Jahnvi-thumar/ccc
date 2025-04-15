<?php
// require 'paypal-sdk/autoload.php';
require 'vendor/autoload.php';

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

$paypal = new ApiContext(
    new OAuthTokenCredential(
        'ATgBLo6BUbmS5UCgIvPDzw-7i9esh6UFSi75q12dRV2Ie6dbijw6ZUpLAbA9zqi82H8qd_RsuDTwuubi',
        'EOvfTV6HkpiEIs2Guf0C3jxAJGvNsA-GdY3RiGlijH8_WlCTk6Ow2zaTyVibjFzdm6NGj710PO97eBHR'
    )
);

$paypal->setConfig([
    'mode' => 'sandbox', // Change to 'live' in production
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'DEBUG'
]);
?>


