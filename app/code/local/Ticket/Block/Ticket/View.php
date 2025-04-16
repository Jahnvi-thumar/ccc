<?php

class Ticket_Block_Ticket_View extends Core_Block_Template{

    protected $_ticketData = null;
    protected $_children = [];
    public function __construct(){
        $this->setTemplate('ticket/view.phtml');
    }

    public function getId()
    {
        return $this->getRequest()->getQuery('ticket_id');
    }

    public function getTicketDetails($parent_id=0){

        if(!is_array($this->_ticketData)){
            $this->_ticketData = [];
            $ticketId = $this->getRequest()->getQuery('ticket_id');
            $all = $this->getRequest()->getQuery('all');
            if($all)
            {
                $this->_ticketData = Mage::getModel('ticket/ticket_comment')
                    ->getCollection()
                    ->addFieldToFilter('ticket_id' , $ticketId)
                    ->getData();
                }
                else{     
                    $this->_ticketData = Mage::getModel('ticket/ticket_comment')
                        ->getCollection()
                        ->addFieldToFilter('ticket_id' , $ticketId)
                        ->addFieldToFilter('is_complete' , 0)
                        ->getData();
            }
        }
        return $this->_ticketData;
    }

    function buildTreeRecursive($comments, $parentId = null) {

        $branch = [];
    
        foreach ($comments as $comment) {
            if ($comment->getParentId() == $parentId) {
                $children = $this->buildTreeRecursive($comments, $comment->getCommentId()); 
                $countOfCildren = 0;
                if ($children) {
                    $comment->setChildren($children);
                    foreach($children as $child){
                        $countOfCildren += 1 + (int) $child->getCountOfChildren();
                    }
                    $comment->setCountOfChildren(count($children));
                } 
                $comment->setCountOfChildren($countOfCildren);
    
                $branch[] = $comment;
            }
        }
    
        return $branch; 
    }

    public function getMaxDepth($comments, $level = 0){
        $max = $level;
        foreach ($comments as $commentObj) {

            if (!empty($commentObj->getChildren())) {
                $childDepth = $this->getMaxDepth($commentObj->getChildren(), $level + 1);
                if ($childDepth > $max) {
                    $max = $childDepth;
                }
            }
        }
        return $max;
    }
    


    // public function rendorTree($comments , $max, $level=0 )
    // {
    //     $html = '';
    //     if(!empty($comments))
    //     {

    //         foreach ($comments as $commentObj) {
                
    //             $rowspan = $commentObj->getCountOfChildren() > 0 ? $commentObj->getCountOfChildren() + 1 : 1;
    
    //             $html .= '<tr>';
    //             $html .= '<td rowspan="' . $rowspan . '" data-comment-id="' . $commentObj->getCommentId() . '">' 
    //                     . htmlspecialchars($commentObj->getName());
                
    //             if (empty($commentObj->getChildren()) && $level == $max) {
    //                 $html .= '<button class="completebtn">Complete</button></td>';
    //                 $html .= '<td class="addreplybtn" data-comment-id="' . $commentObj->getCommentId() . '" ><button>Add Reply</button></td>';
    //             }

    //             $html .= '</td>';
    //             $html .= '</tr>';

                
    //             if (!empty($commentObj->getChildren())) {
    //                 $html .= $this->rendorTree($commentObj->getChildren() , $max , $level+1); 
    //             }
    //         }
    //     }
    //     else{
    //         $html .= '<tr>';
    //         $html .= '<td class="addreplybtn" data-comment-id="0"><button>Add Reply</button></td>';
    //         $html .= '</tr>';

    //     }
    
    //     return $html;
    // }
    

    public function rendorTree($comments, $max, $level = 0)
{
    $html = '';

    if (!empty($comments)) {
        foreach ($comments as $commentObj) {
            $rowspan = $commentObj->getCountOfChildren() > 0 ? $commentObj->getCountOfChildren() + 1 : 1;

            $html .= '<tr>';
            
           if($commentObj->getIsComplete()==1)
           {
               $html .= '<td style="background-color:green" class="level-' . $level . '" rowspan="' . $rowspan . '" data-comment-id="' . $commentObj->getCommentId() . '">' 
                      . htmlspecialchars($commentObj->getName());
           }
           else
           {
               $html .= '<td class="level-' . $level . '" rowspan="' . $rowspan . '" data-comment-id="' . $commentObj->getCommentId() . '">' 
                      . htmlspecialchars($commentObj->getName());
           }

            
            if (empty($commentObj->getChildren()) && $level == $max) {
                
                
                if($commentObj->getIsComplete()==1)
                {
                    $html .= '<td style="background-color:green" class="addreplybtn level-' . ($level + 1) . '" data-comment-id="' . $commentObj->getCommentId() . '">
                              </td>';
                }
                else
                {
                    
                    $html .= '<button class="completebtn">Complete</button></td>';
                    $html .= '<td class="addreplybtn level-' . ($level + 1) . '" data-comment-id="' . $commentObj->getCommentId() . '">
                                <button>Add Reply</button>
                              </td>';
                }
            }

            $html .= '</td>';
            $html .= '</tr>';

            
            if (!empty($commentObj->getChildren())) {
                $html .= $this->rendorTree($commentObj->getChildren(), $max, $level + 1);
            }
        }
    } else {
        
        $html .= '<tr>';
        $html .= '<td class="addreplybtn level-0" data-comment-id="0"><button>Add Reply</button></td>';
        $html .= '</tr>';
    }

    return $html;
}


}    
?>