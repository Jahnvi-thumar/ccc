<?php

class Checkout_Controller_Shipping extends Core_Controller_Front_Action{

    public function indexAction(){

        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/shipping_index')
                ->setTemplate('checkout/shipping/index.phtml');
        $layout->getChild('content')->addChild('index' , $index);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    }

    public function saveAction(){

        $data = Mage::getModel('core/request')->getParams();
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