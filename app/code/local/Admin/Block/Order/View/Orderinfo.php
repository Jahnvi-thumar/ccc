<?php

class Admin_Block_Order_View_Orderinfo extends Core_Block_Template{

    // protected $_orderBlock = null;
    public function __construct(){

        $this->setTemplate('admin/order/view/orderinfo.phtml');
    }

    // public function setOrderBlock($orderBlock){

    //     $this->_orderBlock = $orderBlock;
    //     return $this;
    // }

    public function getOrderData(){

        return $this->getParent()->getOrderModel();
      
    }
    
}

?>