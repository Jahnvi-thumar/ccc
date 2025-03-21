<?php

class Catalog_Model_Filter extends Core_Model_Abstract{

    public function getProductCollection(){

        $collection = Mage::getModel('catalog/product')->getCollection();
        $this->applyFilter($collection);
        return $collection;
    }

    public function applyFilter($collection){

        $request = Mage::getModel('core/request');
        $parameters = $request->getQuery();
        // print_r($parameters['categoryid']);
        if(isset($parameters['categoryid'])){
            // echo'cat filter apply<br>';
            // print_r($parameters['categoryid']);
            $collection->addCategoryFilter($parameters['categoryid']);
            unset($parameters['categoryid']);  

        }

        if(!empty($parameters)){

            $attribute_collection = Mage::getModel('catalog/attribute')
                                        ->getCollection()
                                        ->addFieldToFilter('name' , ['IN' => array_keys($parameters)]);
    
            foreach($attribute_collection->getData() as $attributeCollection){
    
                $collection->addAttributeToFilter($attributeCollection->getName() , ['IN' => $parameters[$attributeCollection->getName()]]);
            
            }

        }                              
       
    }

}

?>