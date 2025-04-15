<?php

class Core_Controller_Front{


    public function init(){
        
        $request = Mage::getModel("core/request");
        $controller = sprintf("%s_Controller_%s" , $request->getModuleName() ,  $request->getControllerName());
        $controller = ucwords($controller , "_");
        $class = new $controller();

        $actionName = $request->getActionName() . 'Action';
        $class->$actionName();
       
        // print_r($req);

    }  

}

?>