<?php

class Core_Block_Html_Elements_Textarea
{
    protected $_data;
    public function __construct($data)
    {
        $this->_data = $data;
    }
    public function render()
    {
        $html = "<textarea ";

        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s'", $this->_data['id']);
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s'", $this->_data['name']);
        }
        if (isset($this->_data['row'])) {
            $html .= sprintf("row='%d'", $this->_data['row']);
        }
        if (isset($this->_data['cols'])) {
            $html .= sprintf("cols='%d'", $this->_data['cols']);
        }
        $html .= ">";
        if (isset($this->_data['value'])) {
            $html .= sprintf("%s", $this->_data['value']);
        }
        $html .= "</textarea>";
        return $html;

    }
}
?>