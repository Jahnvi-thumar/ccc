<?php

class Catalog_Controller_Product extends Core_Controller_Front_Action{


    public function viewAction(){
        // echo get_class() . "----" . __FUNCTION__;
        $product = Mage::getModel('Catalog/Product');
        $product->getResourceModel();
        $product->getResourceModel();
       
        $view = $this->getLayout()->createBlock('Catalog/Product_view');
        $this->getLayout()->getChild('content')->addChild('view' , $view);
        $this->getLayout()->getChild('head')->addCss('catalog/product/view.css');
        $this->getLayout()->getChild('head')->addJs('catalog/product/view.js');
        $this->getLayout()->toHtml();  
    
    
    }

    public function listAction(){
        
        $list = $this->getLayout()->createBlock('Catalog/Product_List');
        $this->getLayout()->getChild('content')->addChild('list' , $list);
        
        if($this->getRequest()->isAjax()){
            
            $this->getLayout()->getChild('content')
                ->getChild('list')
                ->removeChild('filter');
                
            $this->getLayout()->getChild('content')->getChild('list')->getChild('products')->removeChild('toolbar');
            $this->getLayout()->removeChild('header');
            $this->getLayout()->removeChild('footer');
            
        }

        $this->getLayout()->toHtml();     
        
    }

    public function testAction(){
        // echo get_class() . "----" . __FUNCTION__;
        // $product = Mage::getModel('catalog/product')
        //         ->getCollection();
        // $data = $product->getData(); 
        
        // echo "mmmmmm <pre>";
        // print_r($data);

        // $product = Mage::getModel('catalog/product')->getCollection()
        //                                                         //->addFieldToFilter('product_id' , 53)
        //                                                         ->joinSelf(['e1' , 'e2'] , ['A.product_id' , 'B.product_id'] , ['e1.manager_id = e2.employee_id;'])
        //                                                         ->select(['e1.employee_name' , 'e2.employee_name']);
                                                                //->joinRight('catlog_category' , 'catlog_category.category_id = catlog_product.category_id' , ['category_name' => 'name']);

                                                                //->groupBy(['abc' , 'xyz'])
                                                                //->having('product_id' , ['IN' => [2,3,4]])
                                                                //->having('AVG(price)' , ['>' => 100])
                                                                //->orderBy(['qwe DESC' , 'wqe'])
                                                                //->limit(5);
        // $product->getData();

        // echo "<pre>";
        // $collection = Mage::getModel('catalog/product')->load('24');
        //                     // ->getCollection()
        //                     // ->addAttributToSelect(['Color' , 'Brand'])
        //                     // ->limit(5);
        // print_r($collection);

        // echo "<pre>"; 
        $collections = Mage::getModel("catalog/filter")->getProductCollection();
        echo  $collections->prepareQuery();
         
    
    }   
}

?>