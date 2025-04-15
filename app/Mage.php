<?php

class Mage{

    public static $registry;
    public static function init(){
        
        $front = new Core_Controller_Front();
        $front->init();
    }
    public static function getModel($className){

        $class = str_replace("/" , "_Model_" , $className);
        $class = ucwords($class , "_");
        return new $class;
    }

    public static function getBlock($blockName){
        $class = str_replace("/" , "_Block_" , $blockName);
        $class = ucwords($class , "_");
        return new $class;
    }

    public static function getBaseDir(){

        // protected $_baseUrl = "http://localhost/mvc_copy/";
        // protected $_baseDir = 'C:\xampp\htdocs\mvc_copy';
        return 'C:/xampp/htdocs/mvc_copy/';
        
    }

    public static function getBaseUri(){
        return 'http://localhost/mvc_copy/';
    }

    public static function getSingleton($className){
        
        $class = str_replace("/" , "_Model_" , $className);
        $class = ucwords($class , "_");
        
            if(isset(self::$registry[$class])){
                return self::$registry[$class];
            } else {
                return self::$registry[$class] = new $class;
            }
        
    }

    public static function getBlockSingleton($blockName){

        $class = str_replace("/" , "_Block_" , $blockName);
        $class = ucwords($class , "_");
        
            if(isset(self::$registry[$class])){
                return self::$registry[$class];
            } else {
                return self::$registry[$class] = new $class;
            }
    }

    public static function log($data){

        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
?>