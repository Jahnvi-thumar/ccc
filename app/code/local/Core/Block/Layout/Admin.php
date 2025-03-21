<?php

class Core_Block_Layout_Admin extends Core_Block_Layout{

    public function __construct(){

        $this->prepareChildren();
        $this->prepareJsCss();
        $this->_template = 'page/root.phtml';
       
    }

    public function prepareChildren(){

        $header = $this->createBlock('page/header')->setTemplate('page/admin/header.phtml');
        $this->addChild('header' , $header);

        $head = $this->createBlock('page/head');
        $this->addChild('head' , $head);
        

        $content = $this->createBlock('page/content');
        $this->addChild('content' , $content);
        
        $footer = $this->createBlock('page/footer')->setTemplate('page/admin/footer.phtml');
        $this->addChild('footer' , $footer);
    }


    public function prepareJsCss(){

       $head = $this->getChild('head');
    
        $head->addJs('page/common.js')
            ->addCss('page/common.css');
    
    }
     
    public function createBlock($block){

        return Mage::getBlock($block);
    }
}

?>