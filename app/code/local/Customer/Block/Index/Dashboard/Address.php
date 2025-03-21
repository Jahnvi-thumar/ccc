<?php

class Customer_Block_Index_Dashboard_Address extends Core_Block_Template{
    
    public function __construct(){
        $this->setTemplate('customer/index/dashboard/address.phtml');
    }

    public function getAddressData(){

        $customerId = Mage::getSingleton('core/session')->get('customer_id');
        $address = Mage::getModel('customer/customer_address')
            ->getCollection()
            ->addFieldToFilter('customer_id' , $customerId)
            ->getData();
        return $address;
    }
}

?>