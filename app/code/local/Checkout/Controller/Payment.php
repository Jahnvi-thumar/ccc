<?php

class Checkout_Controller_Payment extends Core_Controller_Front_Action{

    public function indexAction(){

        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/payment_index')
                ->setTemplate('checkout/payment/index.phtml');
        $layout->getChild('content')->addChild('index' , $index);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    }

    public function saveAction(){

       
        $data = Mage::getModel('core/request')->getParams();
        
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        
        $cart->setPaymentMethod($data['payment_method'])
            // ->setShippingCharge($shipping->getCharge($data['shipping_method']))
            ->save(); 
            
        $this->redirect('checkout/cart/placeorder');

    }
}

?>