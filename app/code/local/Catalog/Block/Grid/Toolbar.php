<?php

class catalog_Block_Grid_Toolbar extends Core_Block_Template{

    protected $_limit = 5;
    protected $_page = 1;
    protected $_collection;
    public function __construct() {
        $this->setTemplate('catalog/grid/toolbar.phtml');
    }

    public function prepareToolbar(){
        
        $pageNo = $this->getRequest()->getQuery('page');
        $limit = $this->getRequest()->getQuery('limit');
        
        $this->_page = is_numeric($pageNo) ? $pageNo : 1;
        $this->_limit = is_numeric($limit) ? $limit : 5;
       
        $this->_collection = clone $this->getParent()->getCollection();
        $this->getParent()->getCollection()->limit($this->_limit , $this->_page);
    }

    public function getTotalRecords(){
        return count($this->_collection->getData());
        
    }
}
?>