<?php

class Core_Block_Message extends Core_Block_Template{

    public function __construct(){
        $this->setTemplate('core/message.phtml');
    }

    public function showSuccessMessage(){
        // echo '-----------';
        // die;
        return $this->getRequest()->getMessageModel()->getSuccessMessage();
    }
}

?>