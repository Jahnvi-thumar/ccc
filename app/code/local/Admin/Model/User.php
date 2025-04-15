<?php 

class Admin_Model_User extends Core_Model_Abstract{

    
    public function init()
    {
        $this->_resourceClassName = "Admin_Model_Resource_User";
        $this->_collectionClass = "Admin_Model_Resource_User_Collection";
    }

    // public function isAllowed($roleAction){

    //     $role = Mage::getSingleton('admin/role')->load($this->getRoleId());
       
    //     if($role->getPermissions() != ''){
           
    //         $this->_roleAllowedAction = json_decode($role->getPermissions());
    //         return in_array($roleAction, $this->_roleAllowedAction);
    //     }
    //     return false;
    // }
}
?>