<?php

class Checkout_Block_Shipping_Index extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('checkout/shipping/index.phtml');
    }

    public function getShippingMethods() {

        return Mage::getModel('checkout/shipping')
                ->getAllShippingMethods();
    }
}

?>