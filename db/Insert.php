<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once(__DIR__ . '/../config.php');
require_once('Database.php');

class Insert extends Database {

    private $dbName = "kidsGames";
    private $tableName = "score";
    private $registrationOrder;
    private $livesUsed;
    private $dateTime;
    private $status;

    private $fName; 
    private $lName;
    private $userName;
    private $password;
    private $passcode;
    private $currentDateTime;
    //Constructor method 
    public function __construct(){

    }

    function insertHistory($registrationOrder, $livesUsed, $dateTime, $status){
        $this->registrationOrder = $registrationOrder;
        $this->livesUsed = $livesUsed;
        $this->dateTime = $dateTime;
        $this->status = $status;
        
        $this->insertToTableScore($livesUsed, $dateTime, $status);
    }


    //SQL query method
    //private function sql($livesUsed, $dateTime, $status){
    private function sql(){
        $sql['descTableScore'] = "DESC score";
        $sql['descTablePlayer'] = "DESC player";
        $sql['descTableAuthenticator'] = "DESC authenticator";     
        $sql['selectUser'] = "SELECT * FROM player WHERE userName = '" . $this->userName . "'";
        $sql['insertAllColumnsScore'] = "INSERT INTO " . $this->tableName . " (scoreTime, result, livesUsed)
            VALUES ('".$this->dateTime."', '".$this->status."', '".$this->livesUsed."') WHERE registrationOrder = '" . $this->registrationOrder . "';";
        $sql['insertPlayer'] = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES
        ('". $this->fName."', '".$this->lName."', '".$this->userName."', '".$this->currentDateTime."')";
        $sql['selectAuth'] = "SELECT * FROM authenticator WHERE registrationOrder = '". $this->registrationOrder."'";
        $sql['insertAuthenticator']= "INSERT INTO authenticator (passCode, registrationOrder) VALUES 
        ('". $this->passcode ."', '".$this->registrationOrder ."')";
        return $sql;
    }


    function create_player($fName, $lName, $userName, $password) {
        //$mysqli = new mysqli('localhost', 'root', '', 'kidsGames');
        $this->fName = $fName;
        $this->lName = $lName;
        $this->userName = $userName;
        $this->password = $password;
        $this->currentDateTime = date("Y-m-d H:i:s");

        $sql = $this->sql();
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase(DBASE);
        
        //3-EXECUTE THE QUERY TO DESCRIBE THE TABLE
        $this->executeQuery($sql['descTablePlayer']);
        //4-EXECUTE THE QUERY TO INSERT INTO THE TABLE
        $this->executeQuery($sql['insertPlayer']);

        $dataFound = $this->executeQuery($sql['selectUser']);

        // var_dump($dataFound);

        if (!empty($dataFound)) {
            if(count($dataFound) === 1){
                $this->registrationOrder = $dataFound['row1']['registrationOrder'];
                $this->passcode = password_hash($password, PASSWORD_DEFAULT);
            }            
        } 
    }

    function createAuthenticator(){

        $sql = $this->sql();
        $this->connectToMySQL(HOST, USER, PASS);
        $this->selectDatabase(DBASE);
        $this->executeQuery($sql['descTableAuthenticator']);
        $this->executeQuery($sql['insertAuthenticator']);

    }

    //main method
    private function insertToTableScore($livesUsed, $dateTime, $status){
        //Assign sql query
        $sql = $this->sql($livesUsed, $dateTime, $status);
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase($this->dbName);
        //3-EXECUTE THE QUERY TO DESCRIBE THE TABLE
        $this->executeQuery($sql['descTableScore']);
        //4-EXECUTE THE QUERY TO INSERT INTO THE TABLE
        $this->executeQuery($sql['insertAllColumnsScore']);
    }


    public function __destruct(){
        //6-CLOSE THE CONNECTION TO MYSQL
        $this->closeMySQL();
    }
}