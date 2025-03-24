<?php

class Checkout_Controller_Payment extends Core_Controller_Front_Action{

    public function indexAction(){

        $index = $this->getLayout()->createBlock('Checkout/payment_index');
        $this->getLayout()->getChild('content')->addChild('index' , $index);
        $this->getLayout()->getChild('head')->addCss('checkout/payment/index.css');
        $this->getLayout()->getChild('head')->addCss('checkout/payment/index.js');
        $this->getLayout()->toHtml();  
    }

    public function saveAction(){

        $data = $this->getRequest()->getParams();
        
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        $cart->setPaymentMethod($data['payment_method'])
            ->save(); 
            
        $this->redirect('checkout/cart/placeorder');

    }
}

?>