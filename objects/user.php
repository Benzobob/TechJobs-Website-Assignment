<?php

class User{
 
    private $conn;
    public $UserID;
    public $AccountEmail;
    public $Password;
    public $AdminStatus;
    public $Banned;
    public $Firstname;
    public $Surname;
    public $PhoneNum;
    public $Status;
    public $PersonalBio;
    public $Projects;
    
    public $EmployerName;
    public $JobStartDate;
    public $JobEndDate;
    public $JobDescription;
    public $EmployerID;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    function emailExist(){
        $query = "SELECT UserID, Password, AdminStatus, Banned
                FROM UserLogins
                WHERE AccountEmail = ?";

        $stmt = $this->conn->prepare( $query );

        $this->AccountEmail=htmlspecialchars(strip_tags($this->AccountEmail));

        $stmt->bindParam(1, $this->AccountEmail);

        $stmt->execute();

        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->UserID = $row['UserID'];
            $this->Password = $row['Password'];
            $this->AdminStatus = $row['AdminStatus'];
            $this->Banned = $row['Banned'];
            // return true because email exists in the database
            return true;
        }
		else{
        return false;
        }
    }
    
    
    function create(){
        //$this->created=date('Y-m-d H:i:s');
        $query = "INSERT INTO UserLogins
                SET
                    AccountEmail = :AccountEmail,
                    Password = :Password;";

        $stmt = $this->conn->prepare($query);

        $this->AccountEmail=htmlspecialchars(strip_tags($this->AccountEmail));
        $this->Password=htmlspecialchars(strip_tags($this->Password));

        $stmt->bindParam(':AccountEmail', $this->AccountEmail);
        $stmt->bindParam(':Password', $this->Password);

        // hash the password before saving to database
//        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
//        $stmt->bindParam(':password', $password_hash);

        if($stmt->execute()){
        }else{
            $this->showError($stmt);
            return false;
        }
        
        $query2 = "SELECT UserID
        FROM UserLogins
        WHERE AccountEmail = ?";
        $stmt2= $this->conn->prepare($query2);

        $stmt2->bindParam(1, $this->AccountEmail);

        $stmt2->execute();

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->UserID = $row['UserID'];
        
        $_SESSION['id'] = $this->UserID;
       
        $query3 = "INSERT INTO Users
                    SET
                    UserID = :UserID,
                    Firstname = :Firstname,
                    Surname = :Surname;";
        $stmt3 = $this->conn->prepare($query3);
        $this->Firstname=htmlspecialchars(strip_tags($this->Firstname));
        $this->Surname=htmlspecialchars(strip_tags($this->Surname));
        $stmt3->bindParam(':UserID', $this->UserID);
        $stmt3->bindParam(':Firstname', $this->Firstname);
        $stmt3->bindParam(':Surname', $this->Surname);
        if($stmt3->execute()){
            return true;
        }else{
            $this->showError($stmt3);
            return false;
        }
    }
    
    
    function updatePersonal(){
        $query = "UPDATE Users
                SET
                    PhoneNum = :PhoneNum,
                    Status = :Status,
                    PersonalBio = :PersonalBio
                WHERE UserID = :UserID;
                INSERT INTO UserProjects
                SET
                    UserID = :UserID,
                    LinkToCode = :Projects;";

        $stmt = $this->conn->prepare($query);

        $this->PhoneNum=htmlspecialchars(strip_tags($this->PhoneNum));
        $this->Status=htmlspecialchars(strip_tags($this->Status));
        $this->PersonalBio=htmlspecialchars(strip_tags($this->PersonalBio));
        $this->Projects=htmlspecialchars(strip_tags($this->Projects));
        
        $stmt->bindParam(':PhoneNum', $this->PhoneNum);
        $stmt->bindParam(':Status', $this->Status);
        $stmt->bindParam(':PersonalBio', $this->PersonalBio);
        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':Projects', $this->Projects);

        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }
	
	 function updatePersonal1(){
        $query = "UPDATE Users
                SET
                    PhoneNum = :PhoneNum,
                    Status = :Status,
                    PersonalBio = :PersonalBio,
					Firstname = :Firstname,
					Surname = :Surname
                WHERE UserID = :UserID;
                INSERT INTO UserProjects
                SET
                    UserID = :UserID,
                    LinkToCode = :Projects;";

        $stmt = $this->conn->prepare($query);

        $this->PhoneNum=htmlspecialchars(strip_tags($this->PhoneNum));
        $this->Status=htmlspecialchars(strip_tags($this->Status));
        $this->PersonalBio=htmlspecialchars(strip_tags($this->PersonalBio));
        $this->Projects=htmlspecialchars(strip_tags($this->Projects));
        $this->Firstname=htmlspecialchars(strip_tags($this->Firstname));
		$this->Surname=htmlspecialchars(strip_tags($this->Surname));
		
		
        $stmt->bindParam(':PhoneNum', $this->PhoneNum);
        $stmt->bindParam(':Status', $this->Status);
        $stmt->bindParam(':PersonalBio', $this->PersonalBio);
        $stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':Projects', $this->Projects);
		$stmt->bindParam(':Firstname', $this->Firstname);
		$stmt->bindParam(':Surname', $this->Surname);

        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }
	
	function updateUserLogins(){
        $query = "UPDATE UserLogins
                SET
                    AccountEmail = :AccountEmail,
                    Password = :Password
                WHERE UserID = :UserID;";

        $stmt = $this->conn->prepare($query);

        $this->AccountEmail=htmlspecialchars(strip_tags($this->AccountEmail));
        $this->Password=htmlspecialchars(strip_tags($this->Password));
		
		$stmt->bindParam(':UserID', $this->UserID);
        $stmt->bindParam(':AccountEmail', $this->AccountEmail);
        $stmt->bindParam(':Password', $this->Password);

        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }
	
    
    function addEmployment(){        
	
        $query = "INSERT INTO WorkHistory
                SET
                    UserID = :UserID,
                    StartDate = :JobStartDate,
                    EndDate = :JobEndDate,
                    JobDescription = :JobDescription,
                    CompanyName = :EmployerName;";

        $stmt = $this->conn->prepare($query);

        $this->UserID=htmlspecialchars(strip_tags($this->UserID));
        $this->Password=htmlspecialchars(strip_tags($this->Password));

        $stmt->bindParam(':UserID', $this->UserID);   
        $stmt->bindParam(':JobStartDate', $this->JobStartDate);
        $stmt->bindParam(':JobEndDate', $this->JobEndDate);
        $stmt->bindParam(':JobDescription', $this->JobDescription);
        $stmt->bindParam(':EmployerName', $this->EmployerName);

        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }
	
	
	
	
	function setSessionVariable(){
		$query2 = "SELECT UserID
        FROM UserLogins
        WHERE AccountEmail = ?";
        $stmt2= $this->conn->prepare($query2);

        $stmt2->bindParam(1, $this->AccountEmail);

        $stmt2->execute();

        $row = $stmt2->fetch(PDO::FETCH_ASSOC);

        $this->UserID = $row['UserID'];
        
        $_SESSION['id'] = $this->UserID;
	}
    
    function showError(){
        echo "Error";
    }
}
?>