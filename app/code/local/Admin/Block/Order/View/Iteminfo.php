<?php

class Admin_Block_Order_View_Iteminfo extends Core_Block_Template{

    // protected $_orderBlock = null;
    public function __construct(){

        $this->setTemplate('admin/order/view/iteminfo.phtml');
    }

    // public function setOrderBlock($orderBlock){

    //     $this->_orderBlock = $orderBlock;
    //     return $this;
    // }

    public function getAllItems(){

        return $this->getParent()->getOrderModel()->getItemCollection()->getData();

    }

    public function getProduct(){

        
    }
    
}

?>