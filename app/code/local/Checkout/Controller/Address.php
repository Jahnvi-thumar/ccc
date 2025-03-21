<?php

class Checkout_Controller_Address extends Core_Controller_Front_Action{

    public function displayAction(){

        // echo get_class() . "----" . __FUNCTION__;    
        $layout = Mage::getBlock('Core/Layout');
        $display = $layout->createBlock('Checkout/Cart_Address_display')
                ->setTemplate('checkout/cart/address/display.phtml');
        $layout->getChild('content')->addChild('display' , $display);  
        $layout->getChild('head')->addJs('validate.js'); 
        $layout->toHtml();  
    }

    public function addAction(){

        $request = Mage::getModel('core/request');
        $data = $request->getParams();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        // die;

        $cart = Mage::getSingleton('checkout/session')
            ->getCart()
            ->setEmail($data['cart']['email'])
            ->save();

            echo '<pre>';
            print_r($cart);
            echo '</pre>';

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