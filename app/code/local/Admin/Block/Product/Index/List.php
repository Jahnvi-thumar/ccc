<?php

class Admin_Block_Product_Index_List extends Admin_Block_Widgets_Grid{

    protected $_product;
    protected $_collection;
    public function __construct(){

        parent::__construct();
        $this->addColumns('product_id' , 
            [
                'label' => 'product_id',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'product_id'
                
        ]);
        $this->addColumns('name' , 
            [
                'label' => 'Name',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'name'
                
        ]);
        $this->addColumns('description' , 
            [
                'label' => 'description',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'description'
                
        ]);
        $this->addColumns('sku' , 
            [
                'label' => 'sku',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'sku'
                
        ]);
        $this->addColumns('price' , 
            [
                'label' => 'price',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'price'
                
        ]);
        $this->addColumns('stock_quantity' , 
            [
                'label' => 'stock_quantity',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'stock_quantity'
                
        ]);
        $this->addColumns('category_id' , 
            [
                'label' => 'category_id',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'category_id'
                
        ]);
        $this->addColumns('edit' , 
            [
                'label' => 'Edit',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('admin/product_index/new'),
                'data_idx' => 'product_id'
                
        ]);
        $this->addColumns('delete' , 
            [
                'label' => 'Delete',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('admin/product_index/delete'),
                'data_idx' => 'product_id'
        ]);
        $this->init();
        
    }

    public function init(){

        $this->_collection = Mage::getModel('catalog/filter')
            ->getProductCollection();
        
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getProduct(){                
        return $this->getCollection()->getData();
    }
}

?>