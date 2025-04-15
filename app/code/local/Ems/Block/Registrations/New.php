<?php

class Ems_Block_Registrations_New extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('ems/registrations/new.phtml');
    }

    public function getUpcomingEvents(){

        $event = Mage::getModel('ems/event')
            ->getCollection()
            ->addFieldToFilter('date'  , date('Y-m-d'))
            // ->prepareQuery();
            ->getData();
        
        return $event;
    }

    public function getPastEvents(){

        $event = Mage::getModel('ems/event')->getCollection()
                ->addFieldToFilter('date', array('<' => date('Y-m-d H:i:s')))
                ->getData();

        return $event;
                
    }

    

    public function getRegistrationData(){


    }



}

?>