<?php 

class Checkout_Model_Cart_Address extends Core_Model_Abstract{

    public function init()
    {

        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Address";
        $this->_collectionClass = "Checkout_Model_Resource_Cart_Address_Collection";
    }
}

?>

