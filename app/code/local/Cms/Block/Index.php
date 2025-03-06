<?php

class Cms_Block_Index extends Core_Block_Template{
    
    // public function __construct(){
        
    //     $this->setTemplate("cms/index.phtml");
    // }
    

    protected $_product;
    protected $_media;
    public function getProductImageSlider(){

        $this->_product = Mage::getModel('catalog/product')
                ->getCollection()
                ->joinLeft(
                    ['cmg' => 'catalog_media_gallery' ],
                    'cmg.product_id = main_table.product_id' ,
                    ['media_file_path' => 'file_path' , 'media_type' => 'type'] 
                )
                ->groupBy(['cmg.product_id']);
                
        return $this->_product->getData();
    }

    public function getMediaByProduct($product_id){

        $this->_media = Mage::getModel('catalog/media_Gallery')->getCollection()
                                                                      ->addFieldToFilter('product_id' , $product_id)
                                                                      ->getData();
                                        
                                                                      
                                                 
        return $this->_media;                                           
    }
}

?>