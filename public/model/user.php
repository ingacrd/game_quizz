<?php

class User {
    private $fName;
    private $lName; 
    private $userName;


    public function __construct($userName){
        $this->userName = $userName;
    }

    public function setFName($fName){
        $this->fName = $fName;
    }

    public function setLName($lName){
        $this->lName = $lName;
    }
    
    public function getUserName(){
        return $this->userName;
    }

}

?>