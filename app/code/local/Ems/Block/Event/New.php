<?php

class Ems_Block_Event_New extends Core_Block_template{

    public function __construct(){
        $this->setTemplate('ems/event/new.phtml');
    }

    public function getEvent(){

        $event_id = $this->getRequest()->getQuery('event_id');
        
        $data = Mage::getModel('ems/event')
                ->load($event_id);

        return $data;
    }

    
}

?>