<?php

class Catalog_Block_Product_View extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('catalog/product/view.phtml');
    }

    public function getProductDetails($productId){


        $product = Mage::getModel('catalog/product')->load($productId);
        return $product;
    }
}

?>