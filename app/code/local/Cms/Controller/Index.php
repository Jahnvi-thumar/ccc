<?php

class Cms_Controller_Index extends Core_Controller_Front_Action{


    // public function __construct(){

    //     $layout = Mage::getBlock('Core/Layout');
    //     $layout->toHtml();
       
    // }
    public function indexAction(){
        
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Cms/Index')->setTemplate('cms/index.phtml');
        $homeProduct = $layout->createBlock('Cms/Index')->setTemplate('cms/homeProduct.phtml');
        $layout->getChild('content')->addChild('index' , $index)->addChild('homeProduct' , $homeProduct);
        $layout->toHtml();  
    }
}

?>