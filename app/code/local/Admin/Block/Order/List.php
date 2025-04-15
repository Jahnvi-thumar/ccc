<?php

class Admin_Block_Order_List extends Admin_Block_Widgets_Grid{

    protected $_collection;
    public function __construct(){
       
        // $this->setTemplate('admin/order/list.phtml');
        parent::__construct();
        $this->addColumns('order_id', 
    [
        'label' => 'Order ID',
        'type' => 'text',
        'filter' => 'text',
        'data_idx' => 'order_id'
        ]);

        $this->addColumns('customer_id', 
            [
                'label' => 'Customer ID',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'customer_id'
        ]);

        $this->addColumns('email', 
            [
                'label' => 'Email',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'email'
        ]);

        $this->addColumns('coupon_code', 
            [
                'label' => 'Coupon Code',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'coupon_code'
        ]);

        $this->addColumns('coupon_discount', 
            [
                'label' => 'Coupon Discount',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'coupon_discount'
        ]);

        $this->addColumns('shipping_method', 
            [
                'label' => 'Shipping Method',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'shipping_method'
        ]);

        $this->addColumns('shipping_charge', 
            [
                'label' => 'Shipping Charge',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'shipping_charge'
        ]);

        $this->addColumns('payment_method', 
            [
                'label' => 'Payment Method',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'payment_method'
        ]);

        $this->addColumns('total_amount', 
            [
                'label' => 'Total Amount',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'total_amount'
        ]);

        $this->addColumns('order_status', 
            [
                'label' => 'Order Status',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'order_status'
        ]);

        $this->addColumns('ip_address', 
            [
                'label' => 'IP Address',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'ip_address'
        ]);

        $this->init();
    }

    public function init(){

        $this->_collection = Mage::getModel('sells/order')
            ->getCollection();

        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getAllOrders(){
        return $this->getCollection()->getData();
    }
}

?>