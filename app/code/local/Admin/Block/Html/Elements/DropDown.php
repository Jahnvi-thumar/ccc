<?php

class Admin_Block_Html_Elements_DropDown{

    protected $_data = [];

    public function __construct($data){

        $this->_data = $data;
    }

    public function render(){

        $html = "<select ";

        if(isset($this->_data['id'])){

            $html .= sprintf("id='%s'" , $this->_data['id']);
        }
        if(isset($this->_data['class'])){

            $html .= sprintf("class='%s'" , $this->_data['class']);
        }
        if(isset($this->_data['name'])){

            $html .= sprintf("name='%s'" , $this->_data['name']);
        }
        $html .= ">";

        if(isset($this->_data['value'])){

            if(is_array($this->_data['value'])){

                foreach($this->_data['value'] as $val){

                    // print_r($val);

                    $html .= sprintf("<option value='%s'>" , $val);
                    // $html .= $val;
                    $html .= "{$val}";
                    $html .= "</option>";

                }
            }
        }
        

        $html .=  "</select>";
        return $html;
    }

}
?>