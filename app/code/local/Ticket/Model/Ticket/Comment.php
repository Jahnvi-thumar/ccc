<?php

class Ticket_Model_Ticket_Comment extends Core_Model_Abstract{

    public function init()
    {
        $this->_resourceClassName = "Ticket_Model_Resource_Ticket_Comment";
        $this->_collectionClass = "Ticket_Model_Resource_Ticket_Comment_Collection";
    }

    
    public function _afterSave()
    {
        $comment_id = $this->getCommentId();
        $this->load($comment_id);
        $totalChild = Mage::getModel('ticket/ticket_comment')
            ->getCollection()
            ->addFieldToFilter('parent_id', $this->getParentId())
            ->addFieldToFilter('is_complete', 0)
            ->select(['COUNT(*)' => 'total'])
            ->getFirstItem();
        if ($totalChild->getTotal() == 0 && $this->getParentId() != '') {
            Mage::getModel('ticket/ticket_comment')
                ->setCommentId($this->getParentId())
                ->setIsComplete(1)
                ->save();
        }
    }

   

}
?>