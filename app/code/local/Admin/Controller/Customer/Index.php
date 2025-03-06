<?php

class Admin_Controller_Customer_Index extends Core_Controller_Admin_Action{

    public function newAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $new = $layout->createBlock('Admin/Customer_Index_new')
                ->setTemplate('admin/customer/index/new.phtml');
        $layout->getChild('content')->addChild('new' , $new);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();    
    }

    public function listAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Admin/Customer_Index_list')
                ->setTemplate('admin/customer/index/list.phtml');
        $layout->getChild('content')->addChild('list' , $list);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();    
    }
    
    public function saveAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $save = $layout->createBlock('Admin/Customer_Index_save')
                ->setTemplate('admin/customer/index/save.phtml');
        $layout->getChild('content')->addChild('save' , $save);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();          
    }
    
    public function deleteAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $delete = $layout->createBlock('Admin/Customer_Index_delete')
                ->setTemplate('admin/customer/index/delete.phtml');
        $layout->getChild('content')->addChild('delete' , $delete);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();         
    }
}

?>