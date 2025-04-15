<?php

class Catalog_Block_Category_List extends Core_Block_Template{


    public function __construct(){
        $this->setTemplate('catalog/Category/List.phtml');
    }
    public function getCategory(){

        $category = Mage::getModel('catalog/category')
                ->getCollection();

        return $category->getData();
    }

}

?>