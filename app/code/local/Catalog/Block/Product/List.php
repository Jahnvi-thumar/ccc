<?php

class Catalog_Block_Product_List extends Core_Block_Template{

    protected $categoryTree = [];
    

    public function __construct(){

        $this->setTemplate('catalog/product/list.phtml');

        $filter = $this->getLayout()->createBlock('catalog/product_list_filter');
        $this->addChild('filter' , $filter);
        $this->getLayout()->getChild('head')->addCss('catalog/product/list/filter.css');
        $this->getLayout()->getChild('head')->addJs('catalog/product/list/filter.js');

        $products = $this->getLayout()->createBlock('catalog/product_list_products');
        $this->addChild('products' , $products);
        $this->getLayout()->getChild('head')->addCss('catalog/product/list/products.css');
        $this->getLayout()->getChild('head')->addJs('catalog/product/list/products.js');
        
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