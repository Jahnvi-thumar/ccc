<?php

class Catalog_Controller_Category extends Core_Controller_Front_Action{

    public function listAction(){
       
        $list = $this->getLayout()->createBlock('Catalog/Category_List');
        $this->getLayout()->getChild('content')->addChild('view' , $list);
        $this->getLayout()->getChild('head')->addCss('catalog/category/list.css');
        $this->getLayout()->toHtml();  
    }
    
}

?>