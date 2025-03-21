<?php

class Catalog_Controller_Product{


    public function viewAction(){
        // echo get_class() . "----" . __FUNCTION__;
        $product = Mage::getModel('Catalog/Product');
        $product->getResourceModel();
       
        $product->getResourceModel();
        $layout = Mage::getBlock('Core/Layout');
        $view = $layout->createBlock('Catalog/Product_view')
                ->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view' , $view);
        // echo "<pre>";
        // print_r($layout->getChild('content'));
        $layout->toHtml();  
    
    
    }

    public function listAction(){
        // echo get_class() . "----" . __FUNCTION__; 
        $request = Mage::getModel('core/request');
        $layout = Mage::getBlock('Core/Layout');
        $list = $layout->createBlock('Catalog/Product_List')
                ->setTemplate('catalog/product/list.phtml');
        $layout->getChild('content')->addChild('list' , $list);
        
        if($request->isAjax()){
            
            $layout->getChild('content')
                ->getChild('list')
                ->removeChild('filter');
            $layout->removeChild('header');
            $layout->removeChild('footer');
            
        }

        $layout->toHtml();     
        
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