<?php

class Customer_Block_Index_Dashboard_Customer extends Core_Block_Template{
    
    public function __construct(){
        $this->setTemplate('customer/index/dashboard/customer.phtml');
    }

    public function getCustomerData(){

        $customerId = Mage::getSingleton('core/session')->get('customer_id');
        $customer = Mage::getModel('customer/customer')->load($customerId);
        return $customer;
    }
}

?>