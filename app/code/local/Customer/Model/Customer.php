<?php

class Customer_Model_Customer extends Core_Model_Abstract{
    
    public function init()
    {

        $this->_resourceClassName = "Customer_Model_Resource_Customer";
        $this->_collectionClass = "Customer_Model_Resource_Customer_Collection";
    }

    protected function _afterSave(){

        $customer_address = Mage::getModel('customer/customer_address')
            ->getCollection()
            ->addFieldToFilter('customer_id', $this->getCustomerId())
            ->getData();

        // echo '<pre>';
        // print_r($customer_address);
        // echo '</pre>';

        if($customer_address){

        } else {

            Mage::getModel('customer/customer_address')
                ->setData($this->getData())
                ->setCustomerId($this->getCustomerId())
                ->save();
        }
    }

    public function isEmailExist(){

        echo "isemailValid()";

        $customer = Mage::getModel('customer/customer')
            ->load($this->getEmail(), 'email');
           
        return $customer->getEmail() ? true : false;
        
    }

    public function isPasswordValid(){

        $customer = Mage::getModel('customer/customer')
            ->load($this->getPassword(), 'password');
        
            echo "ispasswordValid()";
            var_dump($customer->getPassword());
           
        return $customer->getPassword() ? true : false;
    }
}

?>