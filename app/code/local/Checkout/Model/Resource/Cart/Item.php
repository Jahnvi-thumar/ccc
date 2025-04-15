<?php

class Checkout_Model_Resource_Cart_Item extends Core_Model_Resource_Abstract{
    
    public function _construct(){

        // echo "-------";
        $this->init("cart_item" , "cart_item_id");
    }


}

?>