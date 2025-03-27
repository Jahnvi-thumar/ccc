<?php

class Admin_Block_Widgets_Grid_Filter_Abstract{

    protected $_data = '';
    public function __construct(){

    }

    public function setData($data){
        $this->_data = $data;
        return $this;
    }

    public function getData(){
        return $this->_data;
    }

    public function render(){
        return "";
    }
    
}

?>