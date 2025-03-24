<?php

class Core_Model_Resource_Collection_Abstract {

    protected $_resource = null;
    protected $_model = null; 
    protected $_select = [];  

    public function setResource($resource){
        $this->_resource = $resource;
        return $this;
    }

    public function setModel($model){
        $this->_model = $model;
        return $this;
    }

    public function select($columns = ['*']){

        $this->_select["FROM"] = ["main_table" => $this->_resource->getTableName()];
        $this->_select["COLUMNS"] = [];
        // $this->_select["COLUMNS"] = $columns;
        $columns = is_array($columns) ? $columns : [$columns];
        foreach($columns as $alias=>$column){
            // Mage::log($alias);
            // Mage::log($column);

            if(is_integer($alias)){

                $this->_select['COLUMNS'][] = "main_table.{$column}";
            } else {
                $this->_select['COLUMNS'][] = $alias . " AS " . $column;
            }
        }
        return $this;
        // echo "<pre>";
        // print_r($this);
    }

    public function getData(){

        
        $data = $this->_resource->getAdapter()->fetchAll($this->prepareQuery());
       
        
        foreach($data as &$_data){

            $_model = new $this->_model;
            $_data = $_model->setData($_data);
            // print_r($this->_model);
        }
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // die;
        return $data;
    }

    public function addFieldToFilter($field, $condition){

        if(!is_array($condition)){

            $condition = [ 'eq' => $condition];
        }

        $this->_select['WHERE'][$field][] = $condition;
        return $this;
    }

    public function prepareQuery()
    {
        $query = sprintf("SELECT %s FROM `%s` AS %s", implode(',', 
        $this->_select['COLUMNS']), array_values($this->_select['FROM'])[0] , 
        array_keys($this->_select['FROM'])[0]);
    
        if (isset($this->_select['JOIN_LEFT'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN_LEFT'] as $joinLeft) {
                $joinsql .= sprintf(" LEFT JOIN  %s AS %s ON %s ", array_values($joinLeft['tableName'])[0], array_keys($joinLeft['tableName'])[0] , $joinLeft['condition']);
            }
            $query = $query ." ".$joinsql;
        }

        if (isset($this->_select['JOIN_RIGHT'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN_RIGHT'] as $joinLeft) {
                $joinsql .= sprintf(" RIGHT JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query ." ".$joinsql;
        }

        if (isset($this->_select['JOIN_INNER'])) {
            $joinsql = "";
            foreach ($this->_select['JOIN_INNER'] as $joinLeft) {
                $joinsql .= sprintf(" INNER JOIN  %s ON %s ", $joinLeft['tableName'], $joinLeft['condition']);
            }
            $query = $query ." ".$joinsql;
        }

        if (isset($this->_select['WHERE'])) {
            $wheresql = "";
            $count = count($this->_select['WHERE']);
            $conditions = [];
            foreach ($this->_select['WHERE'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->where($field, $_value);
                }
            }

            $wheresql .= " WHERE " . implode(' AND ', $conditions);

            $query = $query ." ".$wheresql;
            
        }

        if(isset($this->_select['GROUP_BY'])){

            $groupBy = "GROUP BY " . implode("," , $this->_select['GROUP_BY']);
            $query .= " " . $groupBy;
            
        }

        if (isset($this->_select['HAVING']) && $this->_select['GROUP_BY']) {

            $havingsql = "";
            $count = count($this->_select['HAVING']);
            $conditions = [];
            foreach ($this->_select['HAVING'] as $field => $value) {
                foreach ($value as $_value) {
                    $conditions[] = $this->where($field, $_value);
                }
            }

            $havingsql .= " HAVING " . implode(' AND ', $conditions);

            $query = $query ." ".$havingsql;
            
        }

        if(isset($this->_select['ORDER_BY'])){

            $orderBy = "ORDER BY " . implode("," , $this->_select['ORDER_BY']);
            $query .= " " . $orderBy;
            
        }

        if(isset($this->_select['LIMIT'])){

            $limit = sprintf("LIMIT %s OFFSET %s" , $this->_select['LIMIT']['limit'] , $this->_select['LIMIT']['offset']);
            $query .= " " . $limit;
            
        }
    
        // echo $query;
        
        return $query ;
    }

    public function where($field, $value)
    {
    //    echo'<br><pre>where:';print_r($this);echo'</pre>';
    
        if (is_array($value)) {

            foreach ($value as $operator => $_value) {
                // print("<br>val:");
                // print_r($value);
                switch (strtoupper($operator)) {
                    case 'IN':
                    case 'NOT IN':
                        // echo "in";
                            $_value = is_array($_value) ? $_value : explode(',', $_value); // Convert to array if needed
                            $inarryvalues = [];
                    
                            foreach ($_value as $val) {
                                $inarryvalues[] = is_numeric($val) ? $val : "'{$val}'"; // Proper formatting
                            }
                    
                            $_value = implode(',', $inarryvalues);
                            $where  = " {$field} {$operator} ({$_value}) ";
                            break;

                    case 'BETWEEN':
                    case 'NOT BETWEEN':
                        foreach ($value as $key => $val) {
                            if (is_array($val)) {
                                foreach ($val as $limits) {
                                    $betweenvalues[] = (is_string($limits)) ? "'{$limits}'" : "{$limits}";
                                }
                            } else {
                                $betweenvalues[] = (is_string($val)) ? "'{$val}'" : "{$val}";
                            }
                        }
                        $betweenvaluestring = implode(' AND ', $betweenvalues);
                        $where  =   " {$field} {$operator} {$betweenvaluestring}";
                        break;

                    case 'EQ':
                        $where = "{$field} = '{$_value}'";
                        break;

                    default:
                    // echo "default";print_r($value);
                        $where = " {$field} {$operator} '{$_value}' ";
                        break;
                }
            }
        } 
        return $where;
    }
    
    
    public function joinLeft($tableName , $condition , $columns){

        $this->_select['JOIN_LEFT'][] = ['tableName' => $tableName , 'condition' => $condition , 'columns' => $columns];

        foreach($columns as $alias => $columnName){

            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'" , array_keys($tableName)[0] , $columnName , $alias);
            
        }
        
        return $this;
    }

    public function joinRight($tableName , $condition , $columns){

        $this->_select['JOIN_RIGHT'][] = ['tableName' => $tableName , 'condition' => $condition , 'columns' => $columns];

        foreach($columns as $alias => $columnName){

            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'" , $tableName , $columnName , $alias);
            
        }
        return $this;


    }

    public function joinInner($tableName , $condition , $columns){

        $this->_select['JOIN_INNER'][] = ['tableName' => $tableName , 'condition' => $condition , 'columns' => $columns];

        foreach($columns as $alias => $columnName){

            $this->_select['COLUMNS'][] = sprintf("%s.%s AS '%s'" , $tableName , $columnName , $alias);
            
        }
        return $this;


    }

    public function groupBy($fields){

        foreach($fields as $columnNames){

            $this->_select['GROUP_BY'][] = sprintf("%s" , $columnNames);
        }
    
        return $this;
    }

    public function orderBy($fields){

        foreach($fields as $columnNames){

            $this->_select['ORDER_BY'][] = sprintf("%s" , $columnNames);
        }
        
        return $this;
    }

    public function having($field, $condition){

        if(!is_array($condition)){

            $condition = [ 'eq' => $condition];
        }

        $this->_select['HAVING'][$field][] = $condition;
        return $this;
    }

    public function limit($limit , $offset = 0){

        $offset = ($offset-1)*$limit;
        $this->_select['LIMIT'] = ['limit' => $limit , 'offset' => $offset];
            
        // echo "<pre>";
        // print_r($this);
        return $this;

    }
    
    private function getTableAlias($tableName){
        return array_keys($tableName)[0];
    }

    private function getTableName($tableName){
        return array_values($tableName)[0];
    }

    public function getFirstItem(){

        $data = $this->getData();

        if(isset($data[0])){
            return $data[0];
        } else {
            return $this->_model;
        }
    }
    
}

?>