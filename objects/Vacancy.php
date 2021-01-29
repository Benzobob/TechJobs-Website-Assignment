<?php

class Vacancy{
 
    private $conn;
    public $VacID;
    public $CompanyID;
    public $VTitle;
    public $VDescription;
    public $RequiredExp;
    public $SID;
    public $skills;
    public $test;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function createVacancy(){
        $query = "INSERT INTO Vacancies
                 SET
                    CompanyID = :CompanyID,
                    VTitle = :VTitle,
                    VDescription = :VDescription,
                    RequiredExp = :RequiredExp;";
        $stmt = $this->conn->prepare($query);

        $this->CompanyID=htmlspecialchars(strip_tags($this->CompanyID));
        $this->VTitle=htmlspecialchars(strip_tags($this->VTitle));
        $this->VDescription=htmlspecialchars(strip_tags($this->VDescription));
        $this->RequiredExp=htmlspecialchars(strip_tags($this->RequiredExp));

        $stmt->bindParam(':CompanyID', $this->CompanyID);
        $stmt->bindParam(':VTitle', $this->VTitle);
        $stmt->bindParam(':VDescription', $this->VDescription);
        $stmt->bindParam(':RequiredExp', $this->RequiredExp);

        if($stmt->execute()){
           $this->VacID = $this->conn->lastInsertId();
           return true;
           // return true;
        }else{
            return false;
        }
    }
}