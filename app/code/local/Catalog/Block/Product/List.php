<?php

class Catalog_Block_Product_List extends Core_Block_Template{

    // public function __construct(){
    //     $this->setTemplate('catalog/product/list.phtml');
    // }

    //filtered products
    protected $categoryTree = [];

    public function __construct(){

        // $layout = Mage::getBlock('Core/Layout');
        $filter = $this->getLayout()->createBlock('catalog/product_list_filter');
        $products = $this->getLayout()->createBlock('catalog/product_list_products');
        $this->addChild('filter' , $filter);
        $this->addChild('products' , $products);
    }
    public function getAllProducts(){

        $products = Mage::getModel('catalog/filter')
                            ->getProductCollection()
                            // ->prepareQuery();
                            ->addAttributToSelect(['Brand'])
                            ->getData();
                            // echo $products;
                            // print($products->prepareQuery());
                            // echo '<pre>';
                            // print_r($products);
                            // echo '</pre>';
                            // die;
        return $products;
        
    }

    public function getAttributes(){

        $attributes = Mage::getModel('catalog/attribute')
                            ->getCollection()
                            ->getData();

        return $attributes;
    }

    public function getProductAttributes($attributeId = null){

        $product_attributes = Mage::getModel('catalog/product_attribute')
                                    ->getCollection()
                                    ->addFieldToFilter('attribute_id', $attributeId)
                                    ->getData();

        return $product_attributes;
    }
    public function getAllProductsImgs($productId){

        $images  = Mage::getModel('catalog/media_gallery')
                        ->getCollection()
                        ->addFieldToFilter("product_id", $productId)
                        ->getData();
        
        return $images;
    }

    public function getAllCategories($categoryid=0){

        $categories = Mage::getModel('catalog/category')
                            ->getCollection()   
                            ->addFieldToFilter('parent_id' , $categoryid)
                            ->getData();
        
        $this->categoryTree[] = $categories;

        foreach($categories as $category){

            $this->getAllCategories($category->getCategoryId());

        }

        if($categoryid==0){
            
            return $this->categoryTree;
        }

    }
}

?>