<?php

class Ems_Block_Users_Index_List extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('ems/users/list.phtml');
    }

    public function getUpcomingEvents(){

//         SELECT
//     main_table.*,
//     COUNT(r2.customer_id) AS 'total_users'
// FROM
//     `events` AS main_table
// LEFT JOIN registrations AS r2
// ON
//     main_table.event_id = r2.event_id
// WHERE
//     main_table.date >= '2025-04-10' and main_table.capacity > r2.total_users and r2.status IN ('pending' , 'approved')
// GROUP BY
//     main_table.event_id

        $event = Mage::getModel('ems/event')
            ->getCollection()
            ->addFieldToFilter('date'  , ['>=' => date('Y-m-d')])
            ->joinLeft(['r2' => 'registrations'], 'main_table.event_id = r2.event_id', ['total_users' => 'register_id'])
            ->addFieldToFilter('capacity'  , ['>' => 'r2.total_users'])
            ->prepareQuery();
            // ->getData();
        
        $customer_id = Mage::getSingleton('core/session')->get('customer_id');
        $registerUsers = Mage::getModel('ems/event')
            ->getCollection()
            ->addFieldToFilter('date'  , ['>=' => date('Y-m-d')])
            ->joinLeft(['r2' => 'registrations'], 'main_table.event_id = r2.event_id', ['register_id' => 'register_id' , 'customer_id' => 'customer_id' , 'status' => 'status'])
            ->addFieldToFilter('customer_id' , $customer_id)
            ->getData();

            echo '<pre>';
            print_r($event);
            echo '</pre>';
            die;
        return $event;
    }

    public function getPastEvents(){

        $event = Mage::getModel('ems/event')
            ->getCollection()
            ->addFieldToFilter('date', ['<' => date('Y-m-d')])
            ->getData();

        return $event;
                
    }

    

    public function getRegisterData($event_id){

        $customer_id = Mage::getSingleton('core/session')->get('customer_id');
        $registerUser = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id' , $event_id)
            ->addFieldToFilter('customer_id' , $customer_id)
            ->getData();

        // echo '<pre>';
        // print_r($registerUser);
        // echo '</pre>';
        // die;

    }

}

?>