<?php

class Ticket_Model_Ticket_Comment extends Core_Model_Abstract{

    public function init()
    {
        $this->_resourceClassName = "Ticket_Model_Resource_Ticket_Comment";
        $this->_collectionClass = "Ticket_Model_Resource_Ticket_Comment_Collection";
    }

    protected function _afterSave(){

     
        $parent = Mage::getModel('ticket/ticket_comment')->load($this->getParentId());
        // echo '<pre>';
        // print_r($parent);
        // echo '</pre>';
        // die;
    
        // if($this->getParentId() != null || $this->getParentId()!='')
        // {

            $completChild = Mage::getModel('ticket/ticket_comment')
            ->getCollection()
            ->select(['count(*)' => 'complete_child'])
            ->addFieldToFilter('parent_id' , $parent->getCommentId())
            ->addFieldToFilter('is_complete' , 0)
            ->getFirstItem();
            
            Mage::log($completChild);
            
       
        if($completChild->getCompleteChild() == 0){
        
           $parent->setIsComplete(1)
           ->save();
        // }
    }
    }

   

}
?>