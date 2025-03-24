<?php

class Customer_Controller_Account_Address extends Core_Controller_Front_Action{
    
    public function newAction(){

        $address = $this->getLayout()->createBlock('customer/account_address_new');
        $this->getLayout()->getChild('content')->addChild('address' , $address);
        $this->getLayout()->getChild('head')->addCss('customer/account/address/new.css');
        $this->getLayout()->toHtml();
        
    }

    public function saveAction(){

        $customerId = Mage::getModel('customer/session')->getCustomerId();
        // echo $customerId;
        $postData = $this->getRequest()->getParam('customer_address');
        
        Mage::getModel('customer/customer_address')
            ->setData($postData)
            ->setCustomerId($customerId)
            ->save();
    }

    public function deleteAction(){

       
        $address = Mage::getModel('customer/customer_address');
        $addressId = $this->getRequest()->getQuery('address_id');
        $address->load($addressId);
        $address->delete();
        
        header('Location: http://localhost/mvc_copy/customer/index/dashboard');
        exit;

    }
}

?>