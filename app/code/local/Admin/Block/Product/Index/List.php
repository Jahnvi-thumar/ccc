<?php

class Admin_Block_Product_Index_List extends Core_Block_Template{

    protected $_product;
    protected $_collection;
    public function __construct(){

        $this->setTemplate('admin/product/index/list.phtml');
        $this->init();
        
    }

    public function init(){

        $toolbar = $this->getLayout()->createBlock('admin/grid_toolbar');
        $this->addChild('toolbar' , $toolbar);

        $this->_collection = Mage::getModel('catalog/filter')
            ->getProductCollection();
        
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getProduct(){                
        return $this->getCollection()->getData();
    }
}

?>