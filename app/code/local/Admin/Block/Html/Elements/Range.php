<?php

class Admin_Block_Html_Elements_Range{

    protected $_data = [];

    public function __construct($data){

        $this->_data = $data;
    }

    public function render(){

        $html = " {$this->_data['value']} <input type='range'";

        if(isset($this->_data['id'])){

            $html .= sprintf("id='%s'" , $this->_data['id']);
        }
        if(isset($this->_data['class'])){

            $html .= sprintf("class='%s'" , $this->_data['class']);
        }
        if(isset($this->_data['name'])){

            $html .= sprintf("name='%s'" , $this->_data['name']);
        }
        if(isset($this->_data['min'])){

            $html .= sprintf("min='%s'" , $this->_data['min']);
        }
        if(isset($this->_data['max'])){

            $html .= sprintf("max='%s'" , $this->_data['max']);
        }
        if(isset($this->_data['step'])){

            $html .= sprintf("step='%s'" , $this->_data['step']);
        }
        if(isset($this->_data['value'])){

            $html .= sprintf("value='%s'" , $this->_data['value']);
        }

        $html .=  "/>";
        return $html;
    }

}
?>