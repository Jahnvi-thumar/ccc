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
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        
        foreach($data['replies'] as $reply){
            
            if(isset($reply['parent_id']) && $reply['parent_id'] > 0){
                
                    echo 'hieee';
                    $comment = Mage::getModel('ticket/ticket_comment')
                    ->setTicketId($reply['ticket_id'])
                        ->setParentId($reply['parent_id'])
                        ->setName($reply['name'])
                        ->save();
                        $commentIds[] = $comment->getCommentId();
                    }
                    else{
                   
                    $comment = Mage::getModel( 'ticket/ticket_comment')
                        ->setTicketId($reply['ticket_id'])
                        ->setName($reply['name'])
                        ->save();
                        $commentIds[] = $comment->getCommentId();
                        
                }
            }
       

        echo json_encode($commentIds);
    }

    public function updateAction(){

        $data = $this->getRequest()->getParam('replies');
        
        $comment = Mage::getModel('ticket/ticket_comment')->load($data['comment_id']);
        $comment->setCommentId($data['comment_id'])
            ->setTicketId($data['ticket_id'])
            ->setName($data['name'])
            ->setIsComplete($data['is_complete'])
            ->save();
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