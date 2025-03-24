<?php

class Checkout_Controller_Address extends Core_Controller_Front_Action{

    public function displayAction(){

       
        $display = $this->getLayout()->createBlock('Checkout/Cart_Address_display');
        $this->getLayout()->getChild('content')->addChild('display' , $display);  
        $this->getLayout()->getChild('head')->addJs('validate.js'); 
        $this->getLayout()->getChild('head')->addJs('checkout/cart/address/display.js'); 
        $this->getLayout()->getChild('head')->addCss('checkout/cart/address/display.css'); 
        $this->getLayout()->toHtml();  
    }

    public function addAction(){

        $data = $this->getRequest()->getParams();
        $cart = Mage::getSingleton('checkout/session')
            ->getCart()
            ->setEmail($data['cart']['email'])
            ->save();

        $cart_address = Mage::getModel('checkout/cart_address')
            ->setData($data['cart_address'])
            ->setType('billing_address')
            ->setCartId($cart->getCartId())
            ->save();

        $cart_address->setData($data['cart_address'])
            ->setType('shipping_address')
            ->setCartId($cart->getCartId())
            ->save();
        
        $this->redirect('checkout/shipping/index');
            
    }
}

?>