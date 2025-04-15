<?php

class Sells_Model_Resource_Order_Address extends Core_Model_Resource_Abstract{

    public function _construct(){

        $this->init('order_address' , 'address_id');
    }
}

?>