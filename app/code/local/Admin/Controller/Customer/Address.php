<?php

class Admin_Controller_Customer_Address extends Core_Controller_Admin_Action{

    public function newAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $new = $layout->createBlock('Admin/Customer_Address_new')
                ->setTemplate('admin/customer/address/new.phtml');
        $layout->getChild('content')->addChild('new' , $new);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();    
    }

    public function listAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Admin/Customer_Address_list')
                ->setTemplate('admin/customer/address/list.phtml');
        $layout->getChild('content')->addChild('new' , $list);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();      
    }
    
    public function saveAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $save = $layout->createBlock('Admin/Customer_Address_save')
                ->setTemplate('admin/customer/address/save.phtml');
        $layout->getChild('content')->addChild('save' , $save);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();          
    }
    
    public function deleteAction(){
        echo get_class() . "----" . __FUNCTION__;
        $layout = Mage::getBlock('Core/Layout');
        $delete = $layout->createBlock('Admin/Customer_Address_delete')
                ->setTemplate('admin/customer/address/save.phtml');
        $layout->getChild('content')->addChild('delete' , $delete);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();          
    }
}
?>