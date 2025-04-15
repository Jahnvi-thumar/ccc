<?php

class Checkout_Block_Payment_Index extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('checkout/payment/index.phtml');
    }

    // public function getShippingMethods() {

    //     return Mage::getModel('checkout/payment')
    //             ->getAllPaymentsMethods();
    // }

    public function getPaymentMethods() {

        return Mage::getModel('checkout/payment')
                ->getAllPaymentsMethods();
    }
}

?>