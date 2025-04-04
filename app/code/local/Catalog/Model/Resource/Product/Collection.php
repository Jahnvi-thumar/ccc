<?php

class Catalog_Model_Resource_Product_Collection extends Core_Model_Resource_Collection_Abstract{
    
    public function addAttributToSelect($attributes){

        // echo '<pre>';
        // print_r($attributes);
        // echo '</pre>';
        // die;
       
        foreach($attributes as $attribute){

            $a = Mage::getModel('catalog/attribute')
                       ->load($attribute , "name");

            $attribute_id = $a->getAttributeId();
            $this->joinLeft(
                ["cpa_{$a->getName()}" => "catalog_product_attribute"] , 
                "main_table.product_id = cpa_{$a->getName()}.product_id 
                            AND cpa_{$a->getName()}.attribute_id = {$attribute_id}" , 
                            [$a->getName() => "value"]);
                            
        }

        return $this;
        
    }

    public function addCategoryFilter($category_id){

        // echo "1234 ";
        // print_r($category_id);
        return $this->addFieldToFilter('category_id' , ['IN' => $category_id]);
        // return $this;
    }

    public function addAttributeToFilter($attribute, $value){

        $this->addAttributToSelect([$attribute]);
        $this->addFieldToFilter("cpa_{$attribute}.value" , $value);

    }
}

?>