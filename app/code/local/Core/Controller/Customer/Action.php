<?php

class Core_Controller_Customer_Action extends Core_Controller_Front_Action{

    protected $_allowedActions = [];
    public function __construct(){

        $this->_init();
    }

    public function _init(){

        $isLogin = Mage::getSingleton('core/session')->get('customer_id');
        // echo 'isLogin : ' . $isLogin;
        // var_dump($isLogin);
        // echo '<pre> session';
        // print_r($_SESSION['customer_id']);
        // echo '</pre>';
        // die;
        
        if(!in_array($this->getRequest()->getActionName() , $this->_allowedActions)){

            if($isLogin){
               
            } else {
                $this->redirect('customer/index/login');
            }
        }
       
    }

    public function getLayout(){
        
        return Mage::getBlockSingleton('core/layout');
    }
}
?>