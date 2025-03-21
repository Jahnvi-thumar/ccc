<?php

class Checkout_Model_Cart_Item extends Core_Model_Abstract{

    protected $_product = null;
    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];

    public function init()
    {

        $this->_resourceClassName = "Checkout_Model_Resource_Cart_Item";
        $this->_collectionClass = "Checkout_Model_Resource_Cart_Item_Collection";
    }

    protected function _beforeSave(){

        $old_product_data = $this->getCollection()
                              ->addFieldToFilter('cart_id' , $this->getCartId())
                              ->addFieldToFilter('product_id' , $this->getProductId())
                              ->getData();
                            //   ->getFirstItem();
                              
                              
                              
        if(!empty($old_product_data[0]) && !$this->getCartItemId()){

            echo "yessssssssssssss";
            $this->setQuantity($this->getQuantity() + $old_product_data[0]->getQuantity())
                     ->setCartItemId($old_product_data[0]->getCartItemId());

        } 
       
        $this->setPrice($this->getProduct()->getPrice());
        $this->setSubtotal($this->getPrice()*$this->getQuantity());
    
    }

    public function getProduct(){

        $this->_product = Mage::getModel('catalog/product')
                        ->load($this->getProductId());

        return $this->_product;
    }
}
?>