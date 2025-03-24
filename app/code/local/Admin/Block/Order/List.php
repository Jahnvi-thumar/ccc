<?php

class Admin_Block_Order_List extends Core_Block_Template{

    protected $_collection;
    public function __construct(){
       
        $this->setTemplate('admin/order/list.phtml');
        $this->init();
    }

    public function init(){

        $toolbar = $this->getLayout()->createBlock('admin/grid_toolbar');
        $this->addChild('toolbar' , $toolbar);

        $this->_collection = Mage::getModel('sells/order')
            ->getCollection();

        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getAllOrders(){
        return $this->getCollection()->getData();
    }
}

?>