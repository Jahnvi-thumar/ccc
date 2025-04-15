<?php

class Ticket_Controller_Ticket extends Core_Controller_Front_Action{

    public function TicketMenuAction(){

        $menu = $this->getLayout()->createBlock('ticket/ticket_menu');
        $this->getLayout()->getChild('content')->addChild('menu' , $menu);
        $this->getLayout()->getChild('head')->addCss('reply/menu.css');
        $this->getLayout()->toHtml();
    }

    public function saveAction(){
        
        $commentIds = [];
        $data = $this->getRequest()->getParams();
        if($data['parent_id'] > 0)
        {
            foreach($data['name'] as $_name){
                
                $comment = Mage::getModel('ticket/ticket_comment')
                ->setTicketId($data['ticket_id'])
                ->setParentId($data['parent_id'])
                ->setName($_name)
                ->save();
                $commentIds[] = $comment->getCommentId();
            }
        }
        else{
            foreach($data['name'] as $_name){
                
                $comment = Mage::getModel( 'ticket/ticket_comment')
                ->setTicketId($data['ticket_id'])
                ->setName($_name)
                ->save();
                $commentIds[] = $comment->getCommentId();
            }

        }

        echo json_encode($commentIds);
    }

    public function ViewAction(){

        $view = $this->getLayout()->createBlock('ticket/ticket_view');
        $this->getLayout()->getChild('content')->addChild('view' , $view);
        $this->getLayout()->getChild('head')->addCss('ticket/view.css');
        // $this->getLayout()->getChild('head')->addJs('ticket/view.js');
        $this->getLayout()->toHtml();
    }

}

?>