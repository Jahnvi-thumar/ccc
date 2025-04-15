<?php

class Admin_Block_Widgets_Grid extends Core_Block_Template{


    protected $_columns = [];
    protected $_list;

    public function __construct(){

        $this->setTemplate('admin/widgets/grid.phtml');
        $toolbar = $this->getLayout()->createBlock('admin/widgets_grid_toolbar');
        $this->addChild('toolbar' , $toolbar);
    }

    public function addColumns($key , $data): void{
        $type = $data['type'];
        $className = Mage::getBlock('admin/widgets_grid_columns_' . $type);
        $className->setData($data);
        $className->setGrid($this);
        $this->_columns[$key] = $className;
        
    }

    
    
}

?>