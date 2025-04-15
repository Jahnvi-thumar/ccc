<?php

class Ems_Block_Event_List extends Admin_Block_Widgets_Grid{

    protected $_event;
    protected $_collection = null;
    public function __construct(){

        parent::__construct();
        $this->addColumns('event_id' , 
            [
                'label' => 'event_id',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'event_id'
                
        ]);
        $this->addColumns('title' , 
            [
                'label' => 'title',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'title'
                
        ]);
        $this->addColumns('description' , 
            [
                'label' => 'description',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'description'
                
        ]);
        $this->addColumns('date' , 
            [
                'label' => 'date',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'date'
                
        ]);
        $this->addColumns('location' , 
            [
                'label' => 'location',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'location'
                
        ]);
        $this->addColumns('capacity' , 
            [
                'label' => 'capacity',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'capacity'
                
        ]);
        $this->addColumns('created_by' , 
            [
                'label' => 'created_by',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'created_by'
                
        ]);
        $this->addColumns('created_date' , 
            [
                'label' => 'created_date',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'created_date'
                
        ]);
        $this->addColumns('total_registration_count' , 
            [
                'label' => 'total_registration_count',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('ems/event/new'),
                'call_back_function' => 'getCountUrl',
                'count_func' => 'getTotalCount'
                
        ]);
        $this->addColumns('edit' , 
            [
                'label' => 'Edit',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('ems/event/new'),
                'call_back_function' => 'getEditUrl',
                
                
        ]);
        $this->addColumns('delete' , 
            [
                'label' => 'Delete',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('ems/event/delete'),
                'call_back_function' => 'getDeleteUrl',
                
        ]);
        
        $this->init();
        
    }

    public function init(){

        $this->_collection = Mage::getModel('ems/event')
            ->getCollection();
        
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getEvent(){                
        return $this->getCollection()->getData();
    }

    public function getEditUrl($row){
        return $this->getUrl('ems/event/new') . '/?event_id=' . $row->getEventId();
    }

    public function getDeleteUrl($row){
        return $this->getUrl('ems/event/delete') . '/?event_id=' . $row->getEventId();

    }

    public function getCountUrl($row){
        return $this->getUrl('ems/registrations/view') . '/?event_id=' . $row->getEventId() . '&count=1';

    }

    public function getTotalCount($row){

        
        $id = $row->getEventId();
        $registerUsers = Mage::getModel('ems/registrations')
            ->getCollection()
            ->addFieldToFilter('event_id' , $id)
            ->select(['count(*)' => 'total_users'])
            // ->prepareQuery();
            ->getData();
        
        return $registerUsers[0]->getData()['total_users'];
    }

    
}

?>