<?php

class Ems_Block_Registrations_List extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('ems/registrations/list.phtml');
    }

    public function getTotalUsers(){

        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
            ->select(['count(*)' => 'total_users'])
            // ->prepareQuery();
            ->getData();
           
        return $registerUsers[0]->getData()['total_users'];
    }

    public function getPendingUsers(){

        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
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
            ->getCollection()
            ->getData();
        return $events;
    }

    // public function getRegisterUsers($event_id){

    //     $registerUsers = Mage::getModel('ems/registrations')
    //         ->getCollection()
    //         ->addFieldToFilter('event_id' , $event_id)
    //         ->select(['*' , 'count(*)' => 'total_users'])
    //         ->getData();
        
    //     return $registerUsers;
    // }

}

?>