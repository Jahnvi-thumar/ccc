<?php

class Ticket_Controller_Ticket extends Core_Controller_Front_Action{

    public function listAction(){

        $list = $this->getLayout()->createBlock('ticket/ticket_list');
        $this->getLayout()->getChild('content')->addChild('list' , $list);
        $this->getLayout()->toHtml();
    }

    // public function newAction(){
    //     $new = $this->getLayout()->createBlock('ticket/ticket_new');
    //     $this->getLayout()->getChild('content')->addChild('new' , $new);
    //     $this->getLayout()->toHtml();
    // }
    public function saveAction(){
        
        $commentIds = [];
        $data = $this->getRequest()->getParams();
        
        foreach($data['replies'] as $reply){
            
            if(isset($reply['parent_id']) && $reply['parent_id'] > 0){
                
                
                $parent = Mage::getModel('ticket/ticket_comment')
                    ->load($reply['parent_id']);

                $comment = Mage::getModel('ticket/ticket_comment')
                    ->setTicketId($reply['ticket_id'])
                    ->setParentId($reply['parent_id'])
                    ->setLevel($parent->getLevel()+1)
                    ->setName($reply['name'])
                    ->save();
                $commentIds[] = $comment->getCommentId();
            }
            else{
                   
                $comment = Mage::getModel( 'ticket/ticket_comment')
                    ->setTicketId($reply['ticket_id'])
                    ->setName($reply['name'])
                    ->setLevel(0)
                    ->save();
                $commentIds[] = $comment->getCommentId();
                        
            }
        }
       

        echo json_encode($commentIds);
    }

    public function updateAction(){

        $data = $this->getRequest()->getParam('replies');
        
        $comment = Mage::getModel('ticket/ticket_comment')->load($data['comment_id']);
        $comment->setData($data)
            ->setTicketId($data['ticket_id'])
            ->setName($data['name'])
            ->setIsComplete(1)
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