<?php

class Admin_Block_Widgets_Grid_Toolbar extends Core_Block_Template{

    protected $_limit = 5;
    protected $_page = 1;
    protected $_collection;
    public function __construct() {
        $this->setTemplate('admin/widgets/grid/toolbar.phtml');
    }

    public function prepareToolbar(){
        // echo "hello t...oolbar";
        $pageNo = $this->getRequest()->getQuery('page');
        $limit = $this->getRequest()->getQuery('limit');
        // echo $pageNo;
        $this->_page = is_numeric($pageNo) ? $pageNo : 1;
        $this->_limit = is_numeric($limit) ? $limit : 5;
        // echo $this->_page;
        // echo $this->_limit;
        $this->_collection = clone $this->getParent()->getCollection();
        $this->getParent()->getCollection()->limit($this->_limit , $this->_page);
    }

    public function getTotalRecords(){
        return count($this->_collection->getData());
    }
}

?>