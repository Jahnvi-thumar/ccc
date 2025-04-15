<?php

class Admin_Block_Widgets_Grid_Columns_Link extends Admin_Block_Widgets_Grid_Columns_Abstract{
    
    public function render(){
      
        $call_back_fun = $this->_data['call_back_function'];

        $count_func = isset($this->_data['count_func']) ? $this->_data['count_func'] : null;
       
        $link = '<a href=' . $this->getGrid()->$call_back_fun($this->_row) . '>' . $this->_data['label'];

        if(isset($this->_data['count_func'])){
            $link .= ' (' . $this->getGrid()->$count_func($this->_row) . ')';
        }
        $link .= '</a>';
        return $link;
    }


}

?>