<?php 

class Checkout_Model_Session extends Core_Model_Session{

    public function getCart(){

        
        $cartId = $this->get('cart_id');
        // echo 'customerId' . $this->get('customer_id');
        // echo $cartId;
        $cartId = is_null($cartId) ? 0 : $cartId;
        $cart = Mage::getModel('checkout/cart')
            ->load($cartId);
            
            if($cart->getCartId() == ''){
                // echo "yes";
                $cart->setCustomerId($this->get('customer_id'))
                ->setProductId(100)
                ->save();
                
                $this->set('cart_id' , $cart->getCartId());
            }
                
        
        return $cart;
    }
}
?>




