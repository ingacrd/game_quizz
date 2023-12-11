<?php

include('../../config.php');
class Create extends Database {

    //Constructor method 
    public function __construct(){
        $this->createDBComponents();
    }

    //SQL query method
    private function sql(){
        $sql=array();
        $sql['createDB'] = "CREATE DATABASE IF NOT EXISTS " . DBASE;
        $sql['selectAllColumns'] = "SELECT * FROM player";
        $sql['createTablePlayer'] = "CREATE TABLE IF NOT EXISTS player (
                fName VARCHAR(50) NOT NULL, 
                lName VARCHAR(50) NOT NULL, 
                userName VARCHAR(20) NOT NULL UNIQUE,
                registrationTime DATETIME NOT NULL,
                id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
                registrationOrder INTEGER AUTO_INCREMENT,
                PRIMARY KEY (registrationOrder)
                )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; ";
        $sql['createTableAuthenticator'] = "CREATE TABLE IF NOT EXISTS authenticator(   
                passCode VARCHAR(255) NOT NULL,
                registrationOrder INTEGER, 
                FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
                )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; ";
        $sql['createTableScore'] = "CREATE TABLE IF NOT EXISTS score( 
                scoreTime DATETIME NOT NULL, 
                result ENUM('success', 'failure', 'incomplete'),
                livesUsed INTEGER NOT NULL,
                registrationOrder INTEGER, 
                FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
                )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; ";
        $sql['createViewHistory'] = "CREATE VIEW history AS
                SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
                FROM player p, score s
                WHERE p.registrationOrder = s.registrationOrder;";
        $sql['descTable'] = "DESC player";
        $sql['insertDummyDataPlayer1'] = "INSERT INTO player(fName, lName, userName, registrationTime)
            VALUES('Patrick','Saint-Louis', 'sonic12345', now());";
        $sql['insertDummyDataPlayer2'] = "INSERT INTO player(fName, lName, userName, registrationTime)
            VALUES('Marie','Jourdain', 'asterix2023', now());";
        $sql['insertDummyDataPlayer3'] = "INSERT INTO player(fName, lName, userName, registrationTime)
            VALUES('Jonathan','David', 'pokemon', now());";

        $sql['descTableAuth'] = "DESC authenticator";
        $sql['insertDummyDataAuth1'] = "INSERT INTO authenticator(passCode, registrationOrder)
                VALUES('123', 1);";
        $sql['insertDummyDataAuth2'] = "INSERT INTO authenticator(passCode, registrationOrder)
                VALUES('123', 2);";
        $sql['insertDummyDataAuth3'] = "INSERT INTO authenticator(passCode, registrationOrder)
                VALUES('123', 3);";

        $sql['descTableScore'] = "DESC score";
        $sql['insertDummyDataScore1'] = "INSERT INTO (scoreTime, result , livesUsed, registrationOrder)
                VALUES(now(), 'success', 4, 1);";
        $sql['insertDummyDataScore2'] = "INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
                VALUES(now(), 'failure', 6, 2);";
        $sql['insertDummyDataScore3'] = "INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
                VALUES(now(), 'incomplete', 5, 3);";
                       


  

        return $sql;
        
    }

    //main method
    private function createDBComponents(){
        //Assign sql query
        $sql = $this->sql();
        //1-CONNECT TO MYSQL
        $this->connectToMySQL(HOST, USER, PASS);
        //2-EXECUTE THE QUERY TO CREATE THE DATABASE IF IT DOESN'T EXIST YET
        $this->executeQuery($sql['createDB']);
        //3-SELECT THE DATABASE
        $this->selectDatabase(DBASE);
        //4-EXECUTE THE QUERY TO CREATE THE TABLE IF IT DOESN'T EXIST YET
        $this->executeQuery($sql['createTablePlayer']);
        $this->executeQuery($sql['createTableAuthenticator']);
        $this->executeQuery($sql['createTableScore']);
        $this->executeQuery($sql['createViewHistory']);
        
        //5-EXECUTE THE QUERY TO INSERT DUMMY DATA THE TABLE

        $this->executeQuery($sql['descTable']);
        $dataFound = $this->executeQuery($sql['selectAllColumns']);

        if (empty($dataFound)) {
                $this->executeQuery($sql['descTable']);
                $this->executeQuery($sql['insertDummyDataPlayer1']);
                $this->executeQuery($sql['insertDummyDataPlayer2']);
                $this->executeQuery($sql['insertDummyDataPlayer3']);

                $this->executeQuery($sql['descTableAuth']);
                $this->executeQuery($sql['insertDummyDataAuth1']);
                $this->executeQuery($sql['insertDummyDataAuth2']);
                $this->executeQuery($sql['insertDummyDataAuth3']);

                $this->executeQuery($sql['descTableScore']);
                $this->executeQuery($sql['insertDummyDataScore1']);
                $this->executeQuery($sql['insertDummyDataScore2']);
                $this->executeQuery($sql['insertDummyDataScore3']);
        }
        

        
    }

    public function __destruct(){
        //6-CLOSE THE CONNECTION TO MYSQL
        $this->closeMySQL();
    }
}