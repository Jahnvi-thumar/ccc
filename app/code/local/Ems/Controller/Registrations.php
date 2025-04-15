<?php

class Ems_Controller_Registrations extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['new' , 'save' , 'delete' , 'list' , 'view'];
    
    public function saveAction(){

        $data = $_GET;
        $registration = Mage::getModel('ems/registrations')
            ->setData($_GET)
            ->setUpdatedAt(date('Y-m-d H:i:s'))
            ->save();
    }

    public function listAction(){
        
        $list = $this->getLayout()->createBlock('ems/registrations_list');
        $this->getLayout()->getChild('content')->addChild('list', $list);
        $this->getLayout()->toHtml();
    }

    public function viewAction(){

        $view = $this->getLayout()->createBlock('ems/registrations_view');
        $this->getLayout()->getChild('content')->addChild('view', $view);   
        $this->getLayout()->toHtml();
        
        
    }
}

?>