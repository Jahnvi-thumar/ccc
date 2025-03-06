<?php

class Admin_Block_Product_Index_New extends Core_Block_Template{

    protected $_product;
    public $categoryData = [];
    public $attributeData = [];
    public function __construct(){

        $this->setTemplate('admin/product/index/new.phtml');
        
    }

    public function getProduct(){


        
        $id = Mage::getModel('core/request')->getQuery('id');
        
        $this->_product = Mage::getModel('catalog/product')
                ->load($id);

        return $this->_product;
    }

    public function getCategory(){

        $this->categoryData = Mage::getModel('catalog/category')->getCollection()->getData();
        return $this->categoryData;
        
    }

    public function getAttribute(){

        $this->attributeData = Mage::getModel('catalog/attribute')->getCollection()->getData();
        return $this->attributeData;
    }

    public function getHtmlField($field , $data){

        $field = ucfirst(strtolower($field));
        $calssName = sprintf("Core_Block_Html_Elements_%s" , $field);
        $element = new $calssName($data);
        return $element->render();  

        
    }
    
    

    
}

?>