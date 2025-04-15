<?php


class Checkout_Model_Payment extends Core_Model_Abstract{

    protected $_paymentMethods = [
        ["name" => "Credit Card", "processing_fee" => 2.5, "processing_time" => "Instant"],
        ["name" => "Debit Card", "processing_fee" => 1.5, "processing_time" => "Instant"],
        ["name" => "PayPal", "processing_fee" => 3.0, "processing_time" => "Instant"],
        ["name" => "Bank Transfer", "processing_fee" => 0.0, "processing_time" => "2-3 Days"],
        ["name" => "Cash on Delivery", "processing_fee" => 0.0, "processing_time" => "On Delivery"],
        ["name" => "Google Pay", "processing_fee" => 1.0, "processing_time" => "Instant"],
        ["name" => "Apple Pay", "processing_fee" => 1.0, "processing_time" => "Instant"]
    ];
    

    public function getAllPaymentsMethods(){
        return $this->_paymentMethods;
    }

    public function getCharge($name){

        // echo "hello";
        foreach ($this->_paymentMethods as $provider) {
            // print_r($provider );
            // echo "123";
            if ($provider['name'] === $name) {
                // echo "match";
                return $provider['processing_fee'];
            }
        }
        return null;
    }
}

?>