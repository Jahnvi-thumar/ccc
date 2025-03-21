<?php

class Customer_Block_Account_Address_New extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('customer/account/address/new.phtml');
    }

    public function getAllAddress(){

        $customerId = Mage::getModel('customer/session')->getCustomerId();
        echo $customerId;

        return Mage::getModel('customer/customer_address')
            ->getCollection()
            ->addFieldToFilter('customer_id' , $customerId)
            ->getData();

    }

    public function populateAddress(){

        $addressid = Mage::getModel('core/request')->getQuery('address_id');
        echo $addressid;
        
        return Mage::getModel('customer/customer_address')
            ->load($addressid);
    }


}

?>