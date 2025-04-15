<?php

class Admin_Block_Widgets_Grid_Filter_Text extends Admin_Block_Widgets_Grid_Filter_Abstract{
    
    // protected $_data = '';
    public function __construct(){
        // $this->setTemplate('admin/widgets/grid/filter/text.phtml');
    }

    public function render(){
        return '<input type="text" name="filter[' . $this->_data['label'] . ']" placeholder="Enter ' . $this->_data['label'] . '" />';
    }
}

?>