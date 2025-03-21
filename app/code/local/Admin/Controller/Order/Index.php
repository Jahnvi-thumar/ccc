<?php


class Admin_Controller_Order_Index extends Core_Controller_Admin_Action{

    public function listAction(){

        $layout = Mage::getBlock('Core/Layout');
        
        $list = $layout->createBlock('admin/order_list');
        $layout->getChild('content')->addChild('list' , $list);
        $layout->toHtml(); 
                

    }

    public function viewAction(){
        
        $layout = Mage::getBlock('Core/Layout');
        
        $orderId = $this->getRequest()->getQuery('order_id');
        $order = Mage::getModel('sells/order')
            ->load($orderId);

        $view = $layout->createBlock('admin/order_view');
        $view->setOrder($order);
        
        $orderInfo = $layout->createBlock('admin/order_view_orderinfo')
            ->setParent($view);
        $view->addChild('orderinfo' , $orderInfo);

        $itemInfo = $layout->createBlock('admin/order_view_iteminfo')
            ->setParent($view);
        $view->addChild('iteminfo' , $itemInfo);

        $addressInfo = $layout->createBlock('admin/order_view_addressinfo')
            ->setParent($view);
        $view->addChild('addressinfo' , $addressInfo);

        

        $layout->getChild('content')->addChild('view' , $view);
        $layout->toHtml();
                

    }
}
?>