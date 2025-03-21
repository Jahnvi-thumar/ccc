<?php

class Customer_Model_Customer_Address extends Core_Model_Abstract{
    
    public function init()
    {

        $this->_resourceClassName = "Customer_Model_Resource_Customer_Address";
        $this->_collectionClass = "Customer_Model_Resource_Customer_Address_Collection";
    }

    protected function _beforeSave(){

        $address = Mage::getModel('customer/customer_address')
            ->getCollection()
            ->addFieldToFilter('customer_id' , $this->getCustomerId())
            ->addFieldToFilter('is_default' , 1)
            ->getFirstItem();

            if($this->getIsDefault() == 1){

                $address->setIsDefault(0)->save();
            }
        
    }
}

?>