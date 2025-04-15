<?php

class Admin_Block_Widgets_Grid_Columns_Text extends Admin_Block_Widgets_Grid_Columns_Abstract{
    
    public function render(){
        return '<span>' . $this->getValue() . '</span>';
    }

    
}

?>