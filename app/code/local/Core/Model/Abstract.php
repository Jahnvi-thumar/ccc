<?php

class Core_Model_Abstract{

    protected $_resourceClassName;
    protected $_collectionClass = "";

    protected $_data = null;
    public function init(){


    }
    public function __construct()
    {
        $this->init();
    }

    public function getResource(){

        return new $this->_resourceClassName;
    }
    public function __get($name){
        
        return isset($this->_data[$name]) ? $this->_data[$name] : "";
    }

    public function __set($name, $value){

        $this->_data[$name] = $value;
    }

    public function getData(){
        return $this->_data;
    }

    public function setData($data){

        $this->_data = $data;
        return $this;
    }
    public function __call($method , $value){

        $get = substr($method,0,3);
        $field = substr($method,3);

        $field = $this->camelToSnake($field);
        // echo "-----------";
        // echo $field;

        if($get == "get" && strpos($method , " ") === false ){
            return isset($this->_data[$field]) ? $this->_data[$field] : '';
        } else if($get == 'set'){
            $this->_data[$field] = $value[0];
            return $this;
        }
        throw new Exception("Invalid Method");
    }

    function camelToSnake($input) {
 
        
        $snakeCase = preg_replace_callback(
            '/[A-Z]/',
            function($matches) {
                return '_' . strtolower($matches[0]);
            },
            $input
        );
        
        // Remove the leading underscore if it exists and return the result
        return ltrim($snakeCase, '_');
    }

    public function load($value , $field = null){

        $this->_data = $this->getResource()->load( $value , $field);
        $this->_afterLoad();
        return $this;

    }

    public function getCollection(){
        
        $collection = new $this->_collectionClass;
        $collection->setResource($this->getResource())
                    ->setModel($this)
                    ->select();
                    // echo "<pre>";
                    // print_r($collection);
                    // echo "-----------------------------------";
                    return $collection;
    }

    public function save(){

        $this->_beforeSave();
        $this->getResource()->save($this);
        $this->_afterSave();
        return $this;
    }

    public function delete(){

        $this->getResource()->delete($this);
        return $this;
    }

   
    protected function _afterSave()
    {
        // echo "helooooooooollll";
        // die;
        return $this;
    }

    protected function _beforeSave()
    {
        return $this;
    }

    protected function _afterLoad(){

    }

}

?>