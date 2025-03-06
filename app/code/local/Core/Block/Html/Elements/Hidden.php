<?php

class Core_Block_Html_Elements_Hidden
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        $html = "<input type=hidden ";

        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s' ", htmlspecialchars($this->_data['id']));
        }

        if (isset($this->_data['class'])) {
            $html .= sprintf("class='%s' ", htmlspecialchars($this->_data['class']));
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s' ", htmlspecialchars($this->_data['name']));
        }

        if (isset($this->_data['value'])) {
            $html .= sprintf("value='%s' ", htmlspecialchars($this->_data['value']));
        }

        $html .= " readonly>";
        return $html;
    }
}

?>