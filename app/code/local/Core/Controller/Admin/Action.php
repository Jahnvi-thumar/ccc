<?php

class Core_Controller_Admin_Action extends Core_Controller_Front_Action{

    protected $_allowedActions = [];
    protected $_roleAllowedActions = ['login'];
    public function __construct(){
        $this->_init();
    }

    public function _init(){

        $isLogin = $this->getSession()->get('login');
        
        $this->setPermissions();

        $url = $this->getRequest()->getRequestUri();
        $action = explode("/", $url, 2)[1];
        $roleAction = preg_split("/[?#]/", $action)[0];
        $roleAction = rtrim($roleAction, "/");
        
       
        if(!in_array($this->getRequest()->getActionName() , $this->_allowedActions) ){
           
            if($isLogin !== null){
                
            } else {
                $this->redirect('admin/account/login');
            }
        } 
        
    }
    
    public function getLayout(){
        return Mage::getBlockSingleton('core/layout_admin');
    }
    
    public function checkRolePermissions(){

        $url = $this->getRequest()->getRequestUri();
        $action = explode("/", $url, 2)[1];
        $roleAction = preg_split("/[?#]/", $action)[0];
        $roleAction = rtrim($roleAction, "/");
       
        if($this->setPermissions() != ''){
            return in_array($roleAction, $this->_roleAllowedActions);
        }
        return false;
    }

    public function setPermissions(){

        $admin_id = $this->getSession()->get('login');
        $user =  Mage::getSingleton('admin/user')->load($admin_id);
        $this->_roleAllowedActions = json_decode(Mage::getSingleton('admin/role')->load($user->getRoleId())->getPermissions());
        return $this->_roleAllowedActions;
    }
}
?>