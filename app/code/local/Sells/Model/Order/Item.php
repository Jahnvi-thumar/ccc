<?php

class Sells_Model_Order_Item extends Core_Model_Abstract{

    protected $_product = null;
    public function init()
    {

        $this->_resourceClassName = "Sells_Model_Resource_Order_Item";
        $this->_collectionClass = "Sells_Model_Resource_Order_Item_Collection";
    }

    public function getProduct(){

        $this->_product = Mage::getModel('catalog/product')
                        ->load($this->getProductId());

        return $this->_product;
    }
}

?>