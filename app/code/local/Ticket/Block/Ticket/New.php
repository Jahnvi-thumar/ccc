<?php

class Ticket_Block_Ticket_New extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('reply/new.phtml');
    }

    public function getParentComment($parent_id = 0){

        $reply = Mage::getModel('reply/reply')
            ->getCollection()
            ->addFieldToFilter('parent_id' , $parent_id)
            ->getData();

        return $reply;
    }
}

?>