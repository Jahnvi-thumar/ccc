<?php


class Admin_Controller_Order_Index extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['list' , 'view'];
    public function listAction(){
        
        $list = $this->getLayout()->createBlock('admin/order_list');
        $this->getLayout()->getChild('content')->addChild('list' , $list);
        $this->getLayout()->getChild('head')->addCss('admin/order/index/list.css');
        $this->getLayout()->getChild('head')->addJs('admin/order/index/list.js');
        $this->getLayout()->toHtml(); 
                
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
        $this->getLayout()->getChild('head')->addCss('admin/order/index/view.css');
        $this->getLayout()->getChild('head')->addJs('admin/order/index/view.js');
        $layout->toHtml();
                

    }
}
?>