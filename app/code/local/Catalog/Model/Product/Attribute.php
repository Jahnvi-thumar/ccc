<?php

class Catalog_Model_Product_Attribute extends Core_Model_Abstract{


    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];

    public function init()
    {

        $this->_resourceClassName = "Catalog_Model_Resource_Product_Attribute";
        $this->_collectionClass = "Catalog_Model_Resource_Product_Attribute_Collection";
    }

    public function getStatusText(){
        
        $sta = $this->getStatus();

       if(isset($this->status[$this->getStatus()])){
        
        return $this->status[$this->getStatus()];
       } else {
        return "NA";
       }
    }

    
}
?>