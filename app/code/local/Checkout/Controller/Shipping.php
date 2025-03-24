<?php

class Checkout_Controller_Shipping extends Core_Controller_Front_Action{

    public function indexAction(){

        $index = $this->getLayout()->createBlock('Checkout/shipping_index');
        $this->getLayout()->getChild('content')->addChild('index' , $index);
        $this->getLayout()->getChild('head')->addCss('checkout/shipping/index.css');
        $this->getLayout()->getChild('head')->addCss('checkout/shipping/index.js');
        $this->getLayout()->toHtml();  
    }

    public function saveAction(){

        $data = $this->getRequest()->getParams();
        $shipping = Mage::getModel('checkout/shipping');

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        
        echo $data['shipping_method'];
        $cart->setShippingMethod($data['shipping_method'])
            ->setShippingCharge($shipping->getCharge($data['shipping_method']))
            ->save();

            echo '<pre>';
            print_r($cart);
            echo '</pre>';
            // die;

        $this->redirect('checkout/payment/index');
    }
}

?>