<?php 

class Payment_Controller_Paypal extends Core_Controller_Front_Action{

    public function startAction(){

        $init = new PayPal_Init();
        $paypal = $init->getApiContext();
        $payer = new PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');
        $amount = new PayPal\Api\Amount();
        $amount->setTotal('10.00')->setCurrency('USD');
        $transaction = new PayPal\Api\Transaction();
        $transaction->setAmount($amount)->setDescription('Payment for Order #1234');
        $redirectUrls = new PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost/mvc_copy/admin/product_index/success/")
        ->setCancelUrl("http://localhost/practice/mvc/");
        $payment = new PayPal\Api\Payment();
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

    }

    public function successAction()
    {
        $paypal = new Paypal_Init();
        $paypal = $paypal->getApiContext();
        if (!isset($_GET['paymentId'], $_GET['PayerID'])) {
            die("Payment failed or canceled.");
        }

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
       

        try {
            $payment = PayPal\Api\Payment::get($paymentId, $paypal);

            $execution = new PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $paypal);

            if ($result->getState() == 'approved') {
                echo "Payment successful! Transaction ID: " . $result->getId();
                $this->redirect("checkout/cart/convertOrder/?transaction_id={$result->getId()}");
            } else {
                echo "Payment not approved.";
            }

        } catch (Exception $ex) {
            echo "Payment execution error: " . $ex->getMessage();
        }
    }
}

?>