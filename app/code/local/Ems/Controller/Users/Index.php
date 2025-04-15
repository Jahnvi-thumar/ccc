<?php

class Ems_Controller_Users_Index extends Core_Controller_Front_Action{

    public function newAction(){

        $new = $this->getLayout()->createBlock('ems/registrations_new');
        $this->getLayout()->getChild('content')->addChild('new', $new);
        $this->getLayout()->toHtml();
       
    }

    public function deleteAction(){

    }

    public function listAction(){
        $list = $this->getLayout()->createBlock('ems/users_index_list');
        $this->getLayout()->getChild('content')->addChild('list', $list);
        $this->getLayout()->toHtml();
    }

    public function saveAction(){

        $event_id = $this->getRequest()->getQuery('event_id');
        echo $event_id;
        
        $registrations = Mage::getModel('ems/registrations')
            ->setCustomerId($this->getSession()->get('customer_id'))
            ->setEventId($event_id)
            ->setStatus('pending')
            ->setRegisteredAt(date('Y-m-d H:i:s'))
            ->setUpdatedAt(date('Y-m-d H:i:s'))
            ->save();

        // echo '<pre>';
        // print_r($registrations);
        // echo '</pre>';
    }

    

    

}

?>