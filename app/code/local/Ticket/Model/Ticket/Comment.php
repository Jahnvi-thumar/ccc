<?php

class Ticket_Model_Ticket_Comment extends Core_Model_Abstract{

    public function init()
    {
        $this->_resourceClassName = "Ticket_Model_Resource_Ticket_Comment";
        $this->_collectionClass = "Ticket_Model_Resource_Ticket_Comment_Collection";
    }

    public function getAllComments($parent_id=0){

        return Mage::getModel('ticket/ticket_comment')
            ->getCollection()
            ->addFieldToFilter('ticket_id' , 1)
            ->addFieldToFilter('parent_id' , $parent_id)
            ->getData();
            
    }

}
?>