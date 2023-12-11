<?php

class Database {

    private $connection;

    protected function connectToMySQL(){
        //Attempt to connect to MySQL using MySQLi
        $con = new mysqli(HOST, USER, PASS);
        //If connection to MySQL failed, display an error message
        if ($con->connect_error){
            $errorMessage = mysqli_connect_error();
            die("Connection to MySQL failed! <br>" . $errorMessage);
        }
        //If connection to MySQL succeed, assign connection to share it
        else{
            $this->connection = $con;
        }
    }

    protected function selectDatabase($dbName){
        //Attempt to connect to the database 
        $select = mysqli_select_db($this->connection, $dbName);
        if ($select === FALSE){
            $errorMessage = mysqli_connect_error();
            die("Selection of the database". $dbName. "failed! <br>" . $errorMessage);
        }
    }

    protected function executeQuery($sqlCode){
        $data = array();
        //Attempt do execute a query
        $execute = $this->connection->query($sqlCode);
        //If execution of the query failed, display an error message
        if ($this->connection->connect_error){
            $errorMessage = mysqli_connect_error();
            die("Execution of the SQL query [$sqlCode] failed! <br>" . $errorMessage);
        }
        //If execution of the query succeed,assign connection to share it
        else{
            if (isset ($execute->num_rows)){
                //If it's a selectquery, calculate the number of rows available
                $numberOfRowsSelected = $execute->num_rows;
                //Save the rows in an array
                for ($j = 1; $j <= $numberOfRowsSelected; ++$j) {
                    //Assign the records of each row to an associative array
                    $each_row = $execute->fetch_array(MYSQLI_ASSOC);
                    //Assign all the records to an associative 
                    foreach ($each_row as $section => $item)
                        $data["row$j"]["$section"]=$item; 
                }
                return $data;
            }
        }
    }

    protected function closeMySQL(){
        if (isset($this->connection))
            $this->connection->close();
    }

}