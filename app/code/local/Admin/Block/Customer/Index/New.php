<?php

class Admin_Block_Customer_Index_New extends Core_Block_Template{

    // public function __construct(){
    //     $this->setTemplate('catalog/product/list.phtml');
    // }

    public function getHtmlField($field , $data){

        $field = ucfirst(strtolower($field));
        $calssName = sprintf("Admin_Block_Html_Elements_%s" , $field);
        $element = new $calssName($data);
        return $element->render();  

        
    }
}

?>