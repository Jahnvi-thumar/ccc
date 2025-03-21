<?php

class Checkout_Controller_Cart extends Core_Controller_Front_Action{

    public function indexAction(){
        // echo get_class() . "----" . __FUNCTION__;    
        $layout = Mage::getBlock('Core/Layout');
        $index = $layout->createBlock('Checkout/Cart_index')
                ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('index' , $index);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    }
    
    public function updateAction(){
        // echo get_class() . "----" . __FUNCTION__;  
        
        $request = Mage::getModel('core/request');
        $postData = $request->getParams();
       
        $cart = Mage::getModel('checkout/session')
            ->getCart()
            ->updateItem($postData['cart_item_id'] , $postData['quantity'])
            ->save();

        $this->redirect('checkout/cart/index');
    }
    
    public function removeAction(){
        // echo get_class() . "----" . __FUNCTION__;   
        $item_id = Mage::getModel('core/request')->getquery('cart_item_id');
        // echo $item_id;
        
        $cart = Mage::getModel('checkout/session')
            ->getCart()
            ->removeItem($item_id)
            ->save();

        $this->redirect('checkout/cart/index');

    }
    
    public function addAction(){

        $request = Mage::getModel('core/request');
        print_r($request->getParams());
        
        $productId = $request->getParam('product_id');
        $quantity = $request->getParam('quantity');

        $cart_model = Mage::getSingleton('checkout/session')
                            ->getCart()
                            ->addProduct($productId , $quantity)
                            ->save();
        
        // $this->redirect('checkout/cart/index');

    }

    public function applyCouponAction(){

        $code = Mage::getModel('core/request')->getQuery();
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


        // $cartitem_model = Mage::getModel('checkout/cart_item');
        // print_r($cartitem_model->getCollection()->getData());
    }

    
}
?>