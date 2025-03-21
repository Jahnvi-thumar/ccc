<?php

class Admin_Block_Product_Index_List extends Core_Block_Template{

    // public function __construct(){
    //     $this->setTemplate('catalog/product/list.phtml');
    // }

    protected $_product;
    public function __construct(){

        $this->setTemplate('admin/product/index/new.phtml');
        
    }

    public function getProduct(){

        // $this->_product = Mage::getSingleton('catalog/filter')->getProductCollection();
        // return $this->_product->getData();

        

        $products = Mage::getModel('catalog/filter')
                            ->getProductCollection()
                            // ->addAttributToSelect(['brand', 'color', 'country_Of_Origin' , 'model_number' , 'material'])
                            // ->prepareQuery();
                            ->getData();
                            
                            // echo '<pre>';
                            // print_r($products);
                            // echo '</pre>';
                            // die;
        return $products;
    }
}

?>