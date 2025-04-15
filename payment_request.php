<?php
require 'paypal_config.php';

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$amount = new Amount();
$amount->setTotal('10.00')->setCurrency('USD');

$transaction = new Transaction();
$transaction->setAmount($amount)->setDescription('Payment for Order #1234');

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://yourwebsite.com/paypal_success.php")
             ->setCancelUrl("http://yourwebsite.com/paypal_cancel.php");

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions([$transaction]);

try {
    $payment->create($paypal);
    header("Location: " . $payment->getApprovalLink());
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
?>
