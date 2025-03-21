<?php

class Sells_Model_Resource_Order extends Core_Model_Resource_Abstract{

    public function _construct(){

        $this->init('order' , 'order_id');
    }
}

?>