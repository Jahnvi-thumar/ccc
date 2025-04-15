<?php

class Admin_model_Resource_Product_Index extends Core_Model_Resource_Abstract{

    public function _construct(){

        $this->init("catlog_product" , "product_id");
    }
}

?>