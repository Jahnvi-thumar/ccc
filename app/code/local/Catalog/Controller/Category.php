<?php

class Catalog_Controller_Category{

    public function listAction(){
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Catalog/Category_List')
                ->setTemplate('catalog/Category/List.phtml');
        $layout->getChild('content')->addChild('view' , $list);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
        // echo get_class() . "----" . __FUNCTION__;    
    }
    
}

?>