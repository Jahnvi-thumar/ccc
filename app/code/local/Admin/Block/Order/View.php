<?php

class Admin_Block_Order_View extends Core_Block_Template{

    protected $_order;
    public function __construct(){

        $this->setTemplate('admin/order/view.phtml');
    }

    public function setOrder($order){

        $this->_order = $order;
        return $this;
    }

    public function getOrderModel(){

        return $this->_order;
    }
    
}

?>