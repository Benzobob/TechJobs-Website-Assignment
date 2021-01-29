<?php

class Company{
 
    private $conn;
    public $CompanyID;
    public $Name;
    public $Address;
    public $Email;
    public $CompanyDescription;
    public $ContactNum;
    public $EmployeeCount;
    public $Banned;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function emailExist(){
        $query = "SELECT *
                FROM CompanyLogins
                WHERE AccountEmail = ?;";

        $stmt = $this->conn->prepare( $query );

        //$this->Email=htmlspecialchars(strip_tags($this->Email));

        $stmt->bindParam(1, $this->Email);

        $stmt->execute();

        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Password = $row['Password'];
            $this->Banned = $row['Banned'];
            // return true because email exists in the database
            return true;
        }
		else{
        return false;
        }
    }
    
    function createCompany(){
        $query = "INSERT INTO CompanyLogins
                SET
                    AccountEmail = :AccountEmail,
                    Password = :Password,
                    Banned = :Banned;";
        $stmt = $this->conn->prepare($query);

        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->Password=htmlspecialchars(strip_tags($this->Password));

        $stmt->bindParam(':AccountEmail', $this->Email);
        $stmt->bindParam(':Password', $this->Password);
        $stmt->bindParam(':Banned', $this->Banned);
        // hash the password before saving to database
//        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
//        $stmt->bindParam(':password', $password_hash);

        if($stmt->execute()){
            $this->CompanyID = $this->conn->lastInsertId();
        }else{
            echo 'error with first';
            return false;
        }

        $query = "INSERT INTO Companies
                SET
                    CompanyID = :CompanyID,
                    CompanyName = :CompanyName,
                    Address = :Address,
                    CompanyEmail = :CompanyEmail,
                    CompanyDescription = :CompanyDescription,
                    ContactNum = :ContactNum,
                    Employees = :Employees;";
        $stmt = $this->conn->prepare( $query );
        
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Address=htmlspecialchars(strip_tags($this->Address));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
//        $this->CompanyDescription=htmlspecialchars(strip_tags($this->CompanyDescription));
        $this->ContactNum=htmlspecialchars(strip_tags($this->ContactNum));
//        $this->EmployeeCount=htmlspecialchars(strip_tags($this->EmployeeCount));
//        
//        echo "$this->CompanyID . <br>";
//        echo "$this->Name . <br>";
//        echo "$this->Address . <br>";
//        echo "$this->Email . <br>";
//        echo "$this->CompanyDescription . <br>";
//        echo "$this->ContactNum . <br>";
//        echo "$this->EmployeeCount . <br>";

        $stmt->bindParam(':CompanyID', $this->CompanyID);
        $stmt->bindParam(':CompanyName', $this->Name);
        $stmt->bindParam(':Address', $this->Address);
        $stmt->bindParam(':CompanyEmail', $this->Email);
        $stmt->bindParam(':CompanyDescription', $this->CompanyDescription);
        $stmt->bindParam(':ContactNum', $this->ContactNum);
        $stmt->bindParam(':Employees', $this->EmployeeCount);

        if($stmt->execute()){
            return true;
        }else{
            echo 'error with second';
            return false;
        }  
    }
    
    function updateDetails(){
        $query = "UPDATE Companies
                SET
                    CompanyName = :CompanyName,
                    Address = :Address,
                    CompanyEmail = :CompanyEmail,
                    CompanyDescription = :CompanyDescription,
                    ContactNum = :ContactNum,
                    Employees = :Employees
                WHERE CompanyID = :CompanyID;
                UPDATE CompanyLogins
                SET
                    AccountEmail = :AccountEmail
                WHERE CompanyID = :CompanyID;";

        $stmt = $this->conn->prepare($query);

        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Address=htmlspecialchars(strip_tags($this->Address));
        $this->Email=htmlspecialchars(strip_tags($this->Email));
        $this->CompanyDescription=htmlspecialchars(strip_tags($this->CompanyDescription));
        $this->EmployeeCount=htmlspecialchars(strip_tags($this->EmployeeCount));
        $this->ContactNum=htmlspecialchars(strip_tags($this->ContactNum));

        $stmt->bindParam(':CompanyName', $this->Name);
        $stmt->bindParam(':Address', $this->Address);
        $stmt->bindParam(':AccountEmail', $this->Email);
        $stmt->bindParam(':CompanyEmail', $this->Email);
        $stmt->bindParam(':CompanyDescription', $this->CompanyDescription);
        $stmt->bindParam(':ContactNum', $this->ContactNum);
        $stmt->bindParam(':Employees', $this->EmployeeCount);
        $stmt->bindParam(':CompanyID', $this->CompanyID);

        if($stmt->execute()){
            return true;
        }else{
            echo 'error';
            return false;
        }
    }
    
    function setSessionVariable(){
		$query2 = "SELECT CompanyID
        FROM CompanyLogins
        WHERE AccountEmail = ?";
        $stmt2= $this->conn->prepare($query2);

        $stmt2->bindParam(1, $this->Email);

        $stmt2->execute();

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->CompanyID = $row['CompanyID'];
        
        $_SESSION['compID'] = $this->CompanyID;
	}
}
?>