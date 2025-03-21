<?php

class Admin_Block_Order_List extends Core_Block_Template{

    public function __construct(){
       
        $this->setTemplate('admin/order/list.phtml');
        
    }

    public function getAllOrders(){

        $order = Mage::getModel('sells/order')
            ->getCollection()
            // ->prepareQuery();
            ->getData();

        return $order;

    }
}

?>