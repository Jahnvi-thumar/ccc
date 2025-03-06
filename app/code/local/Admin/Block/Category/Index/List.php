<?php

class Admin_Block_Category_Index_List extends Core_Block_Template{

    // public function __construct(){
    //     $this->setTemplate('catalog/product/list.phtml');
    // }

    protected $_category;
    public function __construct(){

        $this->setTemplate('admin/category/index/list.phtml');
        
    }

    public function getCategory(){

        $this->_category = Mage::getModel('catalog/category')
                ->getCollection();

        return $this->_category->getData();
    }
}

?>