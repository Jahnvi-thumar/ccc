<?php

class Ems_Model_Event extends Core_Model_Abstract{
    
    public function init()
    {

        $this->_resourceClassName = "Ems_Model_Resource_Event";
        $this->_collectionClass = "Ems_Model_Resource_Event_Collection";
        
    }
}   
?>