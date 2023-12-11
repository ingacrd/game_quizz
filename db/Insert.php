<?php

class Insert extends Database {

    private $dbName = "kidsGames";
    private $tableName = "score";
    private $registrationOrder;
    private $livesUsed;
    private $dateTime;
    private $status;
    //Constructor method 
    public function __construct($registrationOrder, $livesUsed, $dateTime, $status){
        $this->registrationOrder = $registrationOrder;
        $this->livesUsed = $livesUsed;
        $this->dateTime = $dateTime;
        $this->status = $status;
        
        $this->insertToTable($livesUsed, $dateTime, $status);
    }

//     CREATE TABLE IF NOT EXISTS score( 
//     scoreTime DATETIME NOT NULL, 
//     result ENUM('success', 'failure', 'incomplete'),
//     livesUsed INTEGER NOT NULL,
//     registrationOrder INTEGER, 
//     FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
// )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

    //SQL query method
    private function sql($livesUsed, $dateTime, $status){
        $sql['descTable'] = "DESC " . $this->tableName;
        $sql['insertAllColumns'] = "INSERT INTO " . $this->tableName . " (scoreTime, result, livesUsed)
            VALUES ('$dateTime', '$status', '$livesUsed') WHERE registrationOrder = '" . $this->registrationOrder . "';";
        return $sql;
    }

    //main method
    private function insertToTable($livesUsed, $dateTime, $status){
        //Assign sql query
        $sql = $this->sql($livesUsed, $dateTime, $status);
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-SELECT THE DATABASE
        $this->selectDatabase($this->dbName);
        //3-EXECUTE THE QUERY TO DESCRIBE THE TABLE
        $this->executeQuery($sql['descTable']);
        //4-EXECUTE THE QUERY TO INSERT INTO THE TABLE
        $this->executeQuery($sql['insertAllColumns']);
    }

    public function __destruct(){
        //6-CLOSE THE CONNECTION TO MYSQL
        $this->closeMySQL();
    }
}