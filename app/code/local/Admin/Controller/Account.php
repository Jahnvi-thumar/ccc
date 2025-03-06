<?php

class Admin_Controller_Account extends Core_Controller_Admin_Action{

    protected $_allowedActions = ['login' , 'loginPost'];
    public function loginAction(){

        $layout = Mage::getBlock('core/layout');
        $login = Mage::getBlock('admin/account')
                      ->setTemplate('admin/login.phtml');

        $layout->getChild('content')->addChild('login' , $login);
        $layout->toHtml();
    }

    public function loginPostAction(){

        $session = Mage::getSingleton('core/session');
   
        $params = $this->getRequest()->getParams();
        $user = Mage::getSingleton('admin/user')->load($params['user']['username'] , 'username');

        if($params['user']['password'] == $user->getPasswordHash()){

            echo "login success";
           $session->set('login', '1');
        } else {
            echo "fail";
            $session->remove('login');
        }
    }
   

    
}
?>