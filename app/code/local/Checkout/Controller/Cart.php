<?php

class Checkout_Controller_Cart{

    public function indexAction(){
        echo get_class() . "----" . __FUNCTION__;    
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_index')
                ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('index' , $index);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    }
    
    public function updateAction(){
        echo get_class() . "----" . __FUNCTION__;  
        $layout = Mage::getBlock('Core/Layout');
        $update = $layout->createBlock('Checkout/Cart_update')
                ->setTemplate('checkout/cart/update.phtml');
        $layout->getChild('content')->addChild('update' , $update);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();   
    }
    
    public function removeAction(){
        echo get_class() . "----" . __FUNCTION__;   
        $layout = Mage::getBlock('Core/Layout');
        $remove = $layout->createBlock('Checkout/Cart_remove')
                ->setTemplate('checkout/cart/remove.phtml');
        $layout->getChild('content')->addChild('remove' , $remove);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    }
    
    public function addAction(){
        echo get_class() . "----" . __FUNCTION__; 
        $layout = Mage::getBlock('Core/Layout');
        $add = $layout->createBlock('Checkout/Cart_add')
                ->setTemplate('checkout/cart/add.phtml');
        $layout->getChild('content')->addChild('index' , $add);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();    
    }
}
?>