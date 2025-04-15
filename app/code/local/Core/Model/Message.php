<?php 
class Core_Model_Message extends Core_model_Session{

    public function addMessage($key , $messageText){

        // echo '123';
        $messages = $this->get('message');
        
        if(is_null($messages)){
            $messages = [];
        }
        
        $messages[$key][] = $messageText;
        $this->set('message' , $messages);
        // echo '<pre> message : ';
        // print_r($messages);
        // echo '</pre>';
    }

    public function addError($messageText){
        $this->addMessage('error' , $messageText);
    }

    public function addSuccess($messageText){
        $this->addMessage('success' , $messageText);
    }

    public function addWarning($messageText){
        $this->addMessage('warning' , $messageText);
    }

    public function getSuccessMessage(){

        // echo '123';
        
        $message = $this->get('message');
        // echo '<pre> message';
        // print_r($message);
        // echo '</pre>';
        // die;
        if(is_null($message) || !isset($message['success'])){
            // echo '456';
            
            return [];
        }
        $showmsg = $message['success'];
        // echo '<pre> showmsg';
        // print_r($showmsg);
        // echo '</pre>';
        unset($message['success']);
        $this->set('message' , $message);
        // echo '<pre> showmsg----';
        // print_r($showmsg);
        // echo '</pre>';
        return $showmsg;
    }

    public function getWarningMessage(){
        $message = $this->get('message')['warning'];
        if(is_null($message) || !$message['warning']){
            return [];
        }
        $showmsg = $message['warning'];
        unset($message['warning']);
        $this->set('message' , $message);
        return $showmsg;
    }

    public function getErrorMessage(){
        $message = $this->get('message')['error'];
        if(is_null($message) || !$message['error']){
            return [];
        }
        $showmsg = $message['error'];
        unset($message['error']);
        $this->set('message' , $message);
        return $showmsg;
    }
}

?>

