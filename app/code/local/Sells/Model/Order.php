<?php

class Sells_Model_Order extends Core_Model_Abstract{

    public function init()
    {

        $this->_resourceClassName = "Sells_Model_Resource_Order";
        $this->_collectionClass = "Sells_Model_Resource_Order_Collection";
    }

    public function getItemCollection(){

        $order_items_collections = Mage::getModel('sells/order_item')
                            ->getCollection()
                            ->addFieldToFilter('order_id' , $this->getOrderId());
                            
        return $order_items_collections;
    }

    public function getAddressCollection(){

        return Mage::getModel('sells/order_address')
            ->getCollection()
            ->addFieldToFilter('order_id' , $this->getOrderId());
        
    }

    public function getBillingAddress(){

        return $this->getAddressCollection()
            ->addFieldToFilter('type' , 'billing_address')
            ->getFirstItem();
    }

    public function getShippingAddress(){

        return $this->getAddressCollection()
            ->addFieldToFilter('type' , 'shipping_address')
            ->getFirstItem();
    }

    
}

?>