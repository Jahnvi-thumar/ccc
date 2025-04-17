<?php

class Ticket_Block_Ticket_List extends Admin_Block_Widgets_Grid{

    protected $_ticket;
    protected $_collection = null;
    public function __construct(){

        parent::__construct();
        $this->addColumns('ticket_id' , 
            [
                'label' => 'ticket_id',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'ticket_id'
                
        ]);
        $this->addColumns('subject' , 
            [
                'label' => 'subject',
                'type' => 'text',
                'filter' => 'text',
                'data_idx' => 'subject'
                
        ]);
        $this->addColumns('view' , 
            [
                'label' => 'view',
                'type' => 'link',
                'filter' => '',
                'url' => $this->getUrl('ticket/ticket/view'),
                'call_back_function' => 'getViewUrl'
                
        ]);
        
        
        $this->init();
        
    }

    public function init(){

        $this->_collection = Mage::getModel('ticket/ticket')
            ->getCollection();
        
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function getCollection(){
        return $this->_collection;
    }

    public function getProduct(){                
        return $this->getCollection()->getData();
    }

    public function getviewUrl($row){
        return $this->getUrl('ticket/ticket/view') . '/?ticket_id=' . $row->getTicketId();
    }

    


    
}

?>