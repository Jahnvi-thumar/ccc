<?php

class Customer_Block_Index_New extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('customer/index/new.phtml');
    }

    public function populateData(){

        $customerId = Mage::getModel('customer/session')->getCustomerId();
        echo $customerId;

        $customer = Mage::getModel('customer/customer')->load($customerId);

        return $customer;
    
    }

}

?>