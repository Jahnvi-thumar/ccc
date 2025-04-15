<?php 

class Customer_Model_Session extends Core_Model_Session{

    public function getCustomerId(){
        
        return Mage::getSingleton('core/session')->get('customer_id');
    }
}
?>




