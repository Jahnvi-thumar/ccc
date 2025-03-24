<?php

class Checkout_Block_Cart_Index extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('checkout/cart/index.phtml');
    }

    public function getCartItems(){

        $cart_items = Mage::getSingleton('checkout/session')
                            ->getCart()
                            ->getItemCollection()
                            ->getData();

        foreach($cart_items as $cart_item){

            $cart_item->getProduct();
        }
                            
        return $cart_items;
    }

    public function getSummary(){

        return Mage::getSingleton('checkout/session')
            ->getCart();
        
    }

    public function getTotalOfSubTotal(){

        $cartItems = Mage::getSingleton('checkout/session')
            ->getCart()
            ->getItemCollection()
            ->getData();

        $total = 0;
        foreach($cartItems as $cart_item){

            $total += $cart_item->getSubtotal();
        }
        return $total;
    }
}

?>