<?php

class Ems_Block_Registrations_View extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('ems/registrations/view.phtml');
    }

    public function getRegisterUsers(){
        
        $event_id = $this->getRequest()->getQuery('event_id');

        $registerUsers = Mage::getModel('ems/event')
            ->getCollection()
            ->addFieldToFilter('main_table.event_id' , $event_id)
            ->joinLeft(['r2' => 'registrations'], 'main_table.event_id = r2.event_id', ['register_id' => 'register_id' , 'customer_id' => 'customer_id' , 'status' => 'status'])
            // ->select(['register_id' => 'register_id' , 'customer_id' => 'customer_id' , 'status' => 'status'])
            // ->prepareQuery();
            ->getData();
        
        return $registerUsers;
    }

    public function getCustomerName($customer_id){

        $customer = Mage::getModel('customer/customer')->load($customer_id);
        return $customer->getFirstName() . $customer->getLastName();

    }

    public function getTotalUsers(){

        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id' , $this->getRequest()->getQuery('event_id'))
            ->select(['count(*)' => 'total_users'])
            // ->prepareQuery();
            ->getData();
           
        return $registerUsers[0]->getData()['total_users'];
    }

    public function getPendingUsers(){

        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id' , $this->getRequest()->getQuery('event_id'))
            ->addFieldToFilter('status' , 'pending')
            ->select(['count(*)' => 'total_users'])
            // ->prepareQuery();
            ->getData();
        
            if(($registerUsers[0]->getData()['total_users']) >= 0){
                return $registerUsers[0]->getData()['total_users'];
            } else {
                return 0;
            }
    }

    public function getApprovedUsers(){
        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id' , $this->getRequest()->getQuery('event_id'))
            ->addFieldToFilter('status' , 'approved')
            ->select(['count(*)' => 'total_users'])
            // ->prepareQuery();
            ->getData();
       
       
        if(($registerUsers[0]->getData()['total_users']) >= 0){
            return $registerUsers[0]->getData()['total_users'];
        } else {
            return 0;
        }
    }

    public function getRejectedUsers(){

        $registerUsers = Mage::getModel('ems/registrations')
        ->getCollection()
        ->addFieldToFilter('status' , 'rejected')
        ->addFieldToFilter('event_id' , $this->getRequest()->getQuery('event_id'))
        ->select(['count(*)' => 'total_users'])
        // ->prepareQuery();
        ->getData();
       
        if(isset($registerUsers[0]->getData()['total_users']) >= 0){
            // echo 'hello';
            return $registerUsers[0]->getData()['total_users'];
        } else {
            return 0;
        }
   
    }

    public function getEvents(){

        $events = Mage::getModel('ems/event')
            ->load($this->getRequest()->getQuery('event_id'));
            
        return $events;
    }

}

?>