<?php

class Admin_Block_Widgets_Grid_Columns_Link extends Admin_Block_Widgets_Grid_Columns_Abstract{
    
    public function render(){
        echo '<pre>';
        print_r($this);
        echo '</pre>';
        die;
        return '<a href=' . $this->_data['call_back_funtion']() . '>' . $this->_data['label'] . '</a>';
    }

}

?>