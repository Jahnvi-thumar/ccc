<?php

class Checkout_Model_resource_Cart extends Core_Model_Resource_Abstract{

    public function _construct(){

        $this->init('cart' , 'cart_id');
    }
}

?>