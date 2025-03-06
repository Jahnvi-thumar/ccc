<?php

class Admin_Block_Category_Index_New extends Core_Block_Template{

    protected $_category;
    public $categoryData;
    public function __construct(){

        $this->setTemplate('admin/category/index/new.phtml');
        
    }

    public function getCategory(){


        $this->categoryData = Mage::getModel('catalog/category')->getCollection()->getData();
        // $id = Mage::getModel('core/request')->getQuery('id');
        
        // $this->_category = Mage::getModel('catalog/category')
        //         ->load($id);

        return $this->categoryData;
    }

    public function getHtmlField($field , $data){

        $field = ucfirst(strtolower($field));
        $calssName = sprintf("Core_Block_Html_Elements_%s" , $field);
        $element = new $calssName($data);
        return $element->render();  

        
    }
    

    
}

?>