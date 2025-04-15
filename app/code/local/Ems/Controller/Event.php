<?php

class Ems_Controller_Event extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['new' , 'save' , 'delete' , 'list' , ];
    public function newAction(){

        $new = $this->getLayout()->createBlock('ems/event_new');
        $this->getLayout()->getChild('content')->addChild('new', $new);
        $this->getLayout()->toHtml();
    }

    public function saveAction(){
        
        $data = $this->getRequest()->getParam('events');
        $event = Mage::getModel('ems/event')
            ->setData($data)
            ->setCreatedBy($this->getSession()->get('login'))
            ->setCreatedDate(date('Y-m-d H:i:s'))
            ->save();

        $this->redirect('ems/event/list');
    }

    public function deleteAction(){
        
        $event = Mage::getModel('ems/event');
        $event_id = $this->getRequest()->getQuery('event_id');
        $event->load($event_id);
        $event->delete();

        $this->redirect('ems/event/list');
    }

    public function listAction(){
        
        $list = $this->getLayout()->createBlock('ems/event_list');
        $this->getLayout()->getChild('content')->addChild('list', $list);
        $this->getLayout()->toHtml();
    }
}

?>