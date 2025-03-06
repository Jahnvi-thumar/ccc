<?php

class Core_Model_DB_Adapter{

    public $connect = null;
    protected $_config = [

        "hostname" => "localhost",
        "dbname" => "e_commerce",
        "username" => "root",
        "password" => "",

    ];

    public function connect(){

        if($this->connect == null){
            $this->connect = mysqli_connect(
                $this->_config["hostname"],
                $this->_config["username"],
                $this->_config["password"],
                $this->_config["dbname"]
            );
        } 
        return $this->connect;
    }

    public function fetchAll($query){

        $result = mysqli_query($this->connect(), $query);
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        // echo "pppppppppppppp <pre>";
        // print_r($data);
        return $data;
    }

    public function fetchCol($query){

        $result = mysqli_query($this->connect(), $query);
        $data = [];

        while($row = $result->fetch_column()){
            $data[] = $row;
        }

        // echo "pppppppppppppp <pre>";
        // print_r($data);
        return $data;
    }

    public function fetchRow($query){


        $result = mysqli_query($this->connect(), $query);
        while($row = $result->fetch_assoc()){
            return $row;
        }
       
        // $data = mysqli_fetch_row($result);

        // return $data;

    }

    public function insert($query){

        echo $query;
        $result = mysqli_query($this->connect(), $query);

        while($result){

            return mysqli_insert_id($this->connect());
        }

        
        return false;

    }

    public function query($query){

        $result = mysqli_query($this->connect(), $query);
        return $result;


    }
}

?>