<?php

class Admin_Block_Order_View_Addressinfo extends Core_Block_Template{

    // protected $_orderBlock = null;
    public function __construct(){

        $this->setTemplate('admin/order/view/addressinfo.phtml');
    }

    // public function setOrderBlock($orderBlock){

    //     $this->_orderBlock = $orderBlock;
    //     return $this;
    // }

    public function getBillingAddress(){

        return $this->getParent()->getOrderModel()->getBillingAddress();
    }

    public function getShippingAddress(){
        
        return $this->getParent()->getOrderModel()->getShippingAddress();
    }
}

?>