<?php

class Sells_Model_Order_Address extends Core_Model_Abstract{

    public function init()
    {

        $this->_resourceClassName = "Sells_Model_Resource_Order_Address";
        $this->_collectionClass = "Sells_Model_Resource_Order_address_Collection";
    }
}

?>