<?php

class Core_Block_Html_Elements_Range
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }
    public function render()
    {
        $html = "<input type='range' ";

        if (isset($this->_data['id'])) {
            $html .= sprintf(' id="%s"', $this->_data['id']);
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf(' name="%s"', $this->_data['name']);
        }
        if (isset($this->_data['min'])) {
            $html .= sprintf(' min="%d"', $this->_data['min']);
        }
        if (isset($this->_data['max'])) {
            $html .= sprintf(' max="%d"', $this->_data['max']);
        }
        if (isset($this->_data['step'])) {
            $html .= sprintf(' step="%d"', $this->_data['step']);
        }
        if (isset($this->_data['value'])) {
            $html .= sprintf(' value="%d"', $this->_data['value']);
        }

        $html .= "/>";
        return $html;
    }
}
?>