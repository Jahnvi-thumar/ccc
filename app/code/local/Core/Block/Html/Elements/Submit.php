<?php

class Core_Block_Html_Elements_Submit
{
    protected $_data;
    public function __construct($data)
    {
        $this->_data = $data;
    }
    public function render()
    {
        $html = "<input  type='submit' ";
        if (isset($this->_data['value'])) {
            $html .= sprintf("value='%s'", $this->_data['value']);
        }
        $html .= " >";
        return $html;
    }
}
?>