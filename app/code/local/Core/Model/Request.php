<?php

class Core_Model_Request{

    protected $_moduleName = "";
    protected $_contrllerName = "";
    protected $_actionName = "";
    protected $_baseUrl = "http://localhost/mvc_copy/";
    protected $_baseDir = 'C:\xampp\htdocs\mvc_copy';


    public function __construct(){

        $uri = $this->getRequestUri();
        $uri = array_filter(explode("/" , $uri));
        $this->_moduleName = isset($uri[0]) ? $uri[0] : 'Cms';
        $this->_contrllerName = isset($uri[1]) ? $uri[1] : 'Index';
        $this->_actionName = isset($uri[2]) ? $uri[2] : 'index';
        
    }

    public function getRequestUri(){

        $strurl = $_SERVER['REQUEST_URI'];
        $strurl = str_replace('/mvc_copy/' ,'',$strurl);
        return $strurl;
    }
    public function getModuleName(){
        return $this->_moduleName;
    }

    public function getControllerName(){
        return $this->_contrllerName;
    }

    public function getActionName(){
        return $this->_actionName;
    }

    public function getParam($field){

      
        if(isset($_POST[$field])){
            
            return $_POST[$field];
        } else {
            return "";
        }

    }

    public function getQuery($field = null){
        
        if($field === null){
            return $_GET;
        }
        if(isset($_GET[$field])){
            return $_GET[$field];
        } else {
            return "";
        }

    }

    public function getParams(){

        return $_POST;
    }

    public function isPost(){

        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isget(){
        
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isAjax(){
        
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    }
}

?>