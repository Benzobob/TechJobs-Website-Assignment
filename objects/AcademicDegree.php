<?php

class AcademicDegree{
 
    private $conn;
    public $ADTitle;
    public $ADDescription;
    public $UserID;
    public $ADID;
    public $DegreeDate;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function createDegree(){
        //$this->created=date('Y-m-d H:i:s');
        //53$_SESSION['id'] = $this->UserID;
        $query = "INSERT INTO AcademicDegrees
                SET
                    ADTitle = :ADTitle,
                    ADDescription = :ADDescription;";

        $stmt = $this->conn->prepare($query);

        $this->ADTitle=htmlspecialchars(strip_tags($this->ADTitle));
        $this->ADDescription=htmlspecialchars(strip_tags($this->ADDescription));

        $stmt->bindParam(':ADTitle', $this->ADTitle);
        $stmt->bindParam(':ADDescription', $this->ADDescription);


        if($stmt->execute()){
            $this->ADID = $this->conn->lastInsertId();
        }else{
            $this->showError($stmt);
            return false;
        }
    }
    
    function insertDegree(){
        $query = "INSERT INTO UserDegrees
                    SET
                    UserID = :UserID,
                    ADID = :ADID,
                    DateObtained = :DegreeDate;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':ADID', $this->ADID);
        $stmt->bindParam(':DegreeDate', $this->DegreeDate);
        if($stmt->execute()){
            return true;
        }else{
            echo $this->UserID . "<br>";
            echo $this->ADID . "<br>";
            echo $this->DegreeDate . "<br>";
            return false;
        }
    }
}
?>