<?php

class Core_Block_Html_Elements_FormStart
{

    protected $_data = [];
    public function __construct($data)
    {
        $this->_data = $data;
    }
    public function render()
    {
        $html = "<form ";
        if (isset($this->_data['action'])) {
            $html .= sprintf("action='%s'", $this->_data['action']);

        }
        if (isset($this->_data['method'])) {
            $html .= sprintf("method='%s'", $this->_data['method']);
        }
        if (isset($this->_data['enctype'])) {
            $html .= sprintf("enctype='%s'", $this->_data['enctype']);
        }
        $html .= ">";
        return $html;
    }
}

?>