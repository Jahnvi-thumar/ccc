<?php

class Admin_Block_Product_Index_Test extends Admin_Block_Widgets_Grid{

    protected $_collection = null;
    public function __construct(){
        // $this->setTemplate('admin/product/index/test.phtml');
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
                'call_back_funtion' => 'getEditUrl'
                
        ]);
        $this->addColumns('delete' , 
            [
                'label' => 'Delete',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('admin/product_index/delete'),
                'call_back_funtion' => 'getDeleteUrl'
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

    public function getEditUrl($row){
        return $this->getUrl('admin/product_index/new') . '/?product_id=' . $row->getProductId();
    }

    public function getDeleteUrl($row){
        return $this->getUrl('admin/product_index/delete') . '/?product_id=' . $row->getProductId();

    }

}

?>