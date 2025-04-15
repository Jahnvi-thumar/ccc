<?php 

class Checkout_Model_Convert_Order{

    public function convert($cartObj){

        $cartData = $cartObj->getData();
        unset($cartData['added_at']);
    
        $order = Mage::getModel('sells/Order')
            ->setData($cartData)
            ->save();

        $cartItemData = $cartObj->getItemCollection()
            ->getData();

            
        foreach($cartItemData as $cart_item){
                
            $order_item = Mage::getModel('sells/order_item');
            $cart_item_data = $cart_item->getData();
            unset($cart_item_data['cart_item_id']);
            $order_item->setData($cart_item_data)
                ->setOrderId($order->getOrderId())
                ->save();

        }

        $billingAddress = $cartObj->getBillingAddress()->getData();
        unset($billingAddress['cart_id']);
        unset($billingAddress['address_id']);

        Mage::getModel('sells/order_address')
            ->setData($billingAddress)
            ->setOrderId($order->getOrderId())
            ->save();

        $shippingAddress = $cartObj->getShippingAddress()->getData();
        unset($shippingAddress['cart_id']);
        unset($shippingAddress['address_id']);

        Mage::getModel('sells/order_address')
            ->setData($shippingAddress)
            ->setOrderId($order->getOrderId())
            ->save();
        
    }
}

?>

