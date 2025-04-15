<?php

class Catalog_Model_Media_Gallery extends Core_Model_Abstract{


    public $status = [
        0 => "Disable",
        1 => "Enable"
    ];

    public function init()
    {

        $this->_resourceClassName = "Catalog_Model_Resource_Media_Gallery";
        $this->_collectionClass = "Catalog_Model_Resource_Media_Gallery_Collection";
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