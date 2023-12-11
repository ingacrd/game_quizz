<?php

require_once "../../public/model/user.php";

class Select extends Database {

    private $user;
    private $password;
    private $registrationOrder = 0;

    //Constructor method 
    public function __construct($user, $password ){

        $this->user = $user;
        $this->password = $password;
        
    }

    public function getRegistrationOrder() {
        return $this->registrationOrder;
    }

    public function getViewHistory()
    {
        
        // Connect to MySQL
        $this->connectToMySQL(HOST, USER, PASS);
        // Select the database
        $this->selectDatabase(DBASE);

        // SQL query to retrieve game history
        $sql = "SELECT * FROM history";

        // Execute the query
        $gameHistory = $this->executeQuery($sql);

        return $gameHistory;
    }

    public function setRegistrationOrder() {
        //Assign sql query
        $sql = $this->sql();
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase(DBASE);
        //4-EXECUTE THE QUERY TO SELECT FROM THE TABLE
       

        $dataFound = $this->executeQuery($sql['selectUser']);

        if (!empty($dataFound)) {
        
            if(count($dataFound) === 1){
                $this->registrationOrder = $dataFound['row1']['registrationOrder'];
            }
        }
    }


    //SQL query method
    private function sql(){
        $sql['descTable'] = "DESC player";
        $sql['selectUser'] = "SELECT * FROM player WHERE userName = '" . $this->user . "'";
        $sql['selectAuth'] = "SELECT * FROM authenticator WHERE registrationOrder = '". $this->registrationOrder."'";
        return $sql;
    }
    

    public function checkUserName(){
        //Assign sql query
        $sql = $this->sql();
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase(DBASE);
        //4-EXECUTE THE QUERY TO SELECT FROM THE TABLE
       
        $dataFound = $this->executeQuery($sql['selectUser']);
        if (!empty($dataFound)) {
        
            if(count($dataFound) === 1){
                $this->registrationOrder = $dataFound['row1']['registrationOrder'];
                return true;
            }
            return false;
        } else {
            return false;
        }
            
    }

    public function checkPassword() {
        //Assign sql query
        $sql = $this->sql();
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase(DBASE);
        //4-EXECUTE THE QUERY TO SELECT FROM THE TABLE
        $dataFound = $this->executeQuery($sql['selectAuth']);
        if (!empty($dataFound)) {
            if(count($dataFound) === 1){
                if($this->password === $dataFound['row1']['passCode']){
                    return true;
                }
                return false;
            }
            return false;
        } else {
            return false;
        }
    }

    public function getHashedPassword() {
        // Assuming $this->userName is the username you want to retrieve the password for
        $sql = "SELECT passCode FROM authenticator
                JOIN player ON authenticator.registrationOrder = player.registrationOrder
                WHERE player.userName = '{$this->user}'";

        $result = $this->executeQuery($sql);

        // var_dump($result);

        if ($result && isset($result['row1']['passCode'])) {
            return $result['row1']['passCode'];
        }

        return null; // Return null if an error occurs or no result is found
    }

    public function __destruct(){
        //6-CLOSE THE CONNECTION TO MYSQL
        $this->closeMySQL();
    }
}