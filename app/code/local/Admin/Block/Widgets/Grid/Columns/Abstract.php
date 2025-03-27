<?php

class Admin_Block_Widgets_Grid_Columns_Abstract{

    protected $_data;
    protected $_row;
    public function __construct(){

    }

    public function setData($data){
        $this->_data = $data;
        return $this;
    }

    public function getData(){
        return $this->_data;
    }

    public function setRow($data){
        $this->_row = $data;
        return $this;
    }

    public function getRow(){
        return $this->_row;
    }

    public function getFilter(){
       
        if($this->_data['filter'] != ''){

            $type = $this->_data['type'];
            $className = Mage::getBlock('admin/widgets_grid_filter_' . $type);
            $className->setData($this->_data);
            return $className;
        } else {

            $className = Mage::getBlock('admin/widgets_grid_filter_abstract');
            $className->setData($this->_data);
            return $className;
        }
    }

    public function getValue(){
        return $this->_row->{$this->_data['data_idx']};
    }
    
}

?>