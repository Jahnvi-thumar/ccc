<?php


class Core_Block_Html_Elements_DropDown
{
    protected $_data = [];

    public function __construct($data)
    {
        $this->_data = $data;
    }

    public function render()
    {
        $html = "<select ";
        if (isset($this->_data['id'])) {
            $html .= sprintf("id='%s' ", htmlspecialchars($this->_data['id']));
        }
        if (isset($this->_data['name'])) {
            $html .= sprintf("name='%s' ", htmlspecialchars($this->_data['name']));
        }

        $html .= ">";
        $html .= "<option value='0'>Select Category</option>";

        $nameCount = [];
        $privateId = null;

        if (isset($this->_data['value']) && is_array($this->_data['value'])) {
            foreach ($this->_data['value'] as $cat) {
                if (is_object($cat)) {
                    $id = $cat->getCategoryId();
                    $name = $cat->getName();

                    $nameCount[$name] = ($nameCount[$name] ?? 0) + 1;

                    if ($nameCount[$name] > 1) {
                        $privateId = $id;
                    }

                    $selected = (isset($this->_data['checked']) && (int) $this->_data['checked'] === (int) $id) ? "selected" : "";

                    $html .= sprintf(
                        "<option value='%s' %s>%s</option>",
                        htmlspecialchars($id),
                        $selected,
                        htmlspecialchars($name)
                    );
                }
            }

        }

        $html .= "</select>";
        if ($privateId !== null) {
            $html .= sprintf("<input type='hidden' name='private_id' value='%s'>", htmlspecialchars($privateId));
        }

        return $html;
    }
}


?>  