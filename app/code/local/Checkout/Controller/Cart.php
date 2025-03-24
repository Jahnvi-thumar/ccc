<?php

class Checkout_Controller_Cart extends Core_Controller_Front_Action{

    public function indexAction(){
        
        $index = $this->getLayout()->createBlock('Checkout/Cart_index');
        $this->getLayout()->getChild('content')->addChild('index' , $index);
        $this->getLayout()->getChild('head')->addCss('checkout/cart/index.css');
        $this->getLayout()->toHtml();  
    }
    
    public function updateAction(){
       
        $postData = $this->getRequest()->getParams();
       
        Mage::getModel('checkout/session')
            ->getCart()
            ->updateItem($postData['cart_item_id'] , $postData['quantity'])
            ->save();

        $this->redirect('checkout/cart/index');
    }
    
    public function removeAction(){
        
        $item_id = $this->getRequest()->getquery('cart_item_id');
        
        Mage::getModel('checkout/session')
            ->getCart()
            ->removeItem($item_id)
            ->save();

        $this->redirect('checkout/cart/index');

    }
    
    public function addAction(){
        
        $productId = $this->getRequest()->getParam('product_id');
        $quantity = $this->getRequest()->getParam('quantity');

        Mage::getSingleton('checkout/session')
            ->getCart()
            ->addProduct($productId , $quantity)
            ->save();
        
        // $this->redirect('checkout/cart/index');

    }

    public function applyCouponAction(){

        $code = $this->getRequest()->getQuery();
        $cart_items = Mage::getSingleton('checkout/session')
            ->getCart()
            ->getItemCollection()
            ->getData();

        $total = 0;
        foreach($cart_items as $cart_item){
            
            $total += $cart_item->getSubtotal();
        }
        // echo $total . "<br>";
        
        
        $totalAmount = Mage::getModel('checkout/coupon')
            ->calculateDiscount($code['coupon'] , $total);
        // echo $totalAmount . "<br>";
        
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        if($totalAmount != 0){

            $cart->setCouponCode($code['coupon'])
            ->setCouponDiscount($total-$totalAmount)
            ->save();
        } else {
            echo "hello";
           
            $cart->setCouponCode('')
            ->setCouponDiscount(0)
            ->save();
        }
        // echo '<pre>';
        // print_r($this);
        // echo '</pre>';
       
        $this->redirect('checkout/cart/index');
    }

    public function placeOrderAction(){

       
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();

        $convert = Mage::getModel('checkout/convert_order')
            ->convert($cart);

        $cart->setIsActive(0)->save();
        Mage::getSingleton('checkout/session')->remove('cart_id');

    }

    public function testAction(){

        $item_collection = Mage::getSingleton('checkout/session')
            ->getCart()
            ->getItemCollection();

            $item_collection->select(['SUM(main_table.subtotal)' => 'alias_subtotal' , 'item_id']);
        Mage::log($item_collection->prepareQuery());


    }

    
}
?>