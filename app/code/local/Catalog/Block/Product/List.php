<?php

class Catalog_Block_Product_List extends Core_Block_Template{

    // public function __construct(){
    //     $this->setTemplate('catalog/product/list.phtml');
    // }

    //filtered products
    protected $categoryTree = [];
    public function getAllProducts(){

        $products = Mage::getModel('catalog/filter')
                            ->getProductCollection()
                            ->addAttributToSelect(['brand'])
                            ->getData();
                            
        return $products;
        // $product=Mage::getSingleton("catalog/filter")->getProductCollection()->prepareQuery();
        // print_r($product);
        // die;
    }

    public function getAttributesName(){

        $attributes = Mage::getModel('catalog/attribute')
                            ->getCollection()
                            ->getData();

        return $attributes;
    }
    public function getAllProductsImgs($productId){

        $images  = Mage::getModel('catalog/media_gallery')
                        ->getCollection()
                        ->addFieldToFilter("product_id", $productId)
                        ->getData();
        
        return $images;
    }

    public function getCategories(){

        $categoryid = Mage::getModel('core/request')->getQuery('categoryid');
        
        if($categoryid != null){

            $categories = Mage::getModel('catalog/category')
                                ->getCollection() 
                                ->addFieldToFilter('parent_id' , ['=' => $categoryid])
                                ->getData();

        } else {

            $categories = Mage::getModel('catalog/category')
                                ->getCollection() 
                                ->addFieldToFilter('parent_id' , ['=' => 0])
                                ->getData();

        }

        return $categories;
    }

    public function getAllCategories($categoryid=0){
        echo $categoryid;
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