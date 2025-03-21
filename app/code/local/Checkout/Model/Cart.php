<?php

class Checkout_Model_Cart extends Core_Model_Abstract{

    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];

    public function init()
    {

        $this->_resourceClassName = "Checkout_Model_Resource_Cart";
        $this->_collectionClass = "Checkout_Model_Resource_Cart_Collection";
    }

    protected function _beforeSave(){

        $cart_items = $this->getItemCollection()
                           ->getData();

        $total = 0;
        foreach($cart_items as $cart_item){

            $total = $total + $cart_item->getSubtotal();
        }
        echo "cartBeforesave : <br>";
        echo "total : ". $total . '<br>';
        echo  "coupon discount : " . $this->getCouponDiscount() . '<br>';
        

        $totalAmount = Mage::getModel('checkout/coupon')
            ->calculateDiscount($this->getCouponCode() , $total);

        echo "totalAmount : " . $totalAmount . '<br>';
        if($totalAmount == 0){
            $this->setCouponDiscount(0);
        } else {

            $this->setCouponDiscount($total - $totalAmount);
        }
        echo "coupon discount" . $this->getCouponDiscount() . '<br>';
        // die;

        // $this->setCouponDiscount($total-$totalAmount);

        $subTotal = $total - $this->getCouponDiscount();
        $subTotal += (int) $this->getShippingCharge();

        echo "final total amount : " . $subTotal;
        $this->setTotalAmount($subTotal);
        
    }

    public function getItemCollection(){

        $cart_items_collections = Mage::getModel('checkout/cart_item')
                            ->getCollection()
                            ->addFieldToFilter('cart_id' , $this->getCartId());
                            
        return $cart_items_collections;
    }

    public function getAddressCollection(){

        return Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id' , $this->getCartId());

        
    }

    public function getBillingAddress(){

        return $this->getAddressCollection()
            ->addFieldToFilter('type' , 'billing_address')
            ->getFirstItem();
    }

    public function getShippingAddress(){

        return $this->getAddressCollection()
            ->addFieldToFilter('type' , 'shipping_address')
            ->getFirstItem();
    }

    public function addProduct($productId , $quantity){

        
        $cart_items = Mage::getModel('checkout/cart_item')
                            ->setProductId($productId)    
                            ->setQuantity($quantity)
                            ->setCartId($this->getCartId())
                            ->save();              
        return $this;                  
    }

    public function removeItem($cart_item_id){

        $cart_items = $this->getItemCollection()
            ->getData();

        foreach($cart_items as $cart_item){

            if($cart_item->getCartItemId() == $cart_item_id){
                $cart_item->delete();
            }
        }

        return $this;
    }

    public function updateItem($item_id , $quantity){

        $cart_items = $this->getItemCollection()
            ->getData();

        echo $item_id;

        foreach($cart_items as $cart_item){

            if($cart_item->getCartItemId() == $item_id){

                echo "yesss=====";
                $cart_item->setQuantity($quantity)
                    ->save();
                
            }
        }

        return $this;
    }
}
?>