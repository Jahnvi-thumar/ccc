<?php


class Checkout_Model_Coupon extends Core_Model_Abstract{

    public $coupons = [
        'NEW10' => 10,
        'SAVE10' => 10,
        'SAVE20' => 20,
        'SAVE30' => 30,
        'SAVE40' => 40,
        'SAVE50' => 50,
    ];

    public function getAllCoupons(){

        return $this->coupons;
    }

    public function calculateDiscount($couponCode , $total){

        if (array_key_exists($couponCode, $this->coupons)) {

            // $finalAmount = $total - (($total*$this->coupons[$couponCode])/100);
            $finalAmount = ($total*(100-$this->coupons[$couponCode]))/100;
            return $finalAmount;

        } else {
             
            return 0;
        }

    }
}

?>