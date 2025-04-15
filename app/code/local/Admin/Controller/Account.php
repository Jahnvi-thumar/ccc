<?php

class Admin_Controller_Account extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['login' , 'loginPost'];
    protected $_roleAllowedActions = ['login' , 'loginPost'];

    public function loginAction(){

        $login = $this->getLayout()->createBlock('admin/account');
                
        $this->getLayout()->getChild('content')->addChild('login' , $login);
        $this->getLayout()->getChild('head')->addCss('admin/login.css');
        $this->getLayout()->toHtml();
    }

    public function loginPostAction(){

        $session = Mage::getSingleton('core/session');
   
        $params = $this->getRequest()->getParams();
        $user = Mage::getSingleton('admin/user')->load($params['user']['username'] , 'username');
        
        if($params['user']['password'] == $user->getPasswordHash()){

            // echo "login success";
           $session->set('login', $user->getAdminId());
        } else {
            // echo "fail";
            $session->remove('login');
        }
    }
   

    
}
?>