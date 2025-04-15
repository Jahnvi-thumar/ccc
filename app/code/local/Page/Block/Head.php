<?php

class Page_Block_Head extends Core_Block_Template{

    protected $_js = [];
    protected $_css = [];
    public function __construct(){

        $this->setTemplate("page/head.phtml");
    }

    public function addjs($fileName){

        $this->_js[] = $fileName;
        return $this;
    }

     public function addCss($fileName){

        $this->_css[] = $fileName;
        return $this;
    }

    public function getJs(){
        return $this->_js;
    }

    public function getCss(){
        return $this->_css;
    }
    

}

?>