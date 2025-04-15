<?php

class Catalog_Block_Product_List_Products extends Catalog_Block_Product_List{

    protected $_collection;
    public function __construct(){
        $this->setTemplate('catalog/product/list/products.phtml');
        $this->init();
    }
    
    public function init(){

        $toolbar = $this->getLayout()->createBlock('catalog/grid_toolbar');
        $this->addChild('toolbar' , $toolbar);
        $this->getLayout()->getChild('head')->addCss('catalog/grid/toolbar.css');

        $this->_collection = Mage::getModel('catalog/filter')
            ->getProductCollection()
            ->addAttributToSelect(['Brand']);
        
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        
        return $this->_collection;
    }

    public function getAllProducts(){

        
        $products = $this->getCollection()
            ->getData();
        return $products;
        
    }

    
}
?>