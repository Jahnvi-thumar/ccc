<?php 

class Payment_Model_Order_Payment extends Core_Model_Abstract{

    public function init()
    {
        $this->_resourceClassName = "Payment_Model_Resource_Order_Payment";
        $this->_collectionClass = "Payment_Model_Resource_Order_Payment_Collection";
        
    }
}
?>