<?php

class Admin_model_Resource_Category_Index extends Core_Model_Resource_Abstract{

    public function _construct(){

        $this->init("catalog_category" , "catalog_id");
    }
}

?>