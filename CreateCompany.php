<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Create Company </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Styles.css">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

<body>

<?php
$page_title = "Create New User";
include "config/core.php";
//include_once "login_checker.php";
//include_once "layout_head.php";
// include classes
include_once 'config/database.php';
include_once 'objects/Company.php';


    // if form was posted
if($_POST){
    $database = new Database();
    $db = $database->getConnection();
    $company = new Company($db);
 
    // set user email to detect if it already exists
    $company->Email=$_POST['compEmail'];
 
    // check if email already exists
    if($company->emailExist()){
        echo "<div class='alert alert-danger'>";
            // echo "The email you specified is already registered. Please try again or <a href='{$home_url}login'>login.</a>";
            echo 'The email you specified is already registered. Please try again or <a href="CompanyLogin.php">login.</a>';
        echo "</div>";
    }
 
    else{
        // set values to object properties
        $company->Name=$_POST['compName'];
		$company->Password=$_POST['password'];
		$company->Banned=0;
        
        $company->Address=$_POST['compAddress'];
        $company->ContactNum=$_POST['compNum'];
        $company->CompanyDescription=$_POST['CompanyDescription'];
        $company->EmployeeCount=$_POST['empCount'];

 
		// create the company
		if($company->createCompany()){
    		echo "<div class='alert alert-info'>";
    		echo 'Successfully registered. Redirecting to personal info page. <meta http-equiv="refresh" content="3; url=CompanyLogin.php">';
 		    echo "</div>";
 
		    // empty posted values
 		   $_POST=array();
 
		}else{
 		   echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
		}
 	}
}
?>
    
    
<form action='CreateCompany.php' method='post' id='register'>

<nav class="navbar navbar-expand-sm">
<div class="d-inline-block" style="width:100px"></div>

        <div class ="d-inline-block">
                <a href="Intro.php"><i><image src="images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</div>
	
	<div class="d-inline-block">
    <a class="info" href="CompanyLogIn.php" style="font-size:15px;width:100px;"><i><p1>Already have a company account?</p1></i></a> 
  </div>
</nav>

<div class="container">
  <div class="row1">
    <h3> Tell Us About <br>
	Your Company
	</h3>
	</div>
	
	<div class="row">
	  <label for="compName"><strong>Company Name:</strong> </label><br>
	  <input type="text" placeholder="Enter Company Name" name="compName" required>  
	</div>

    <div class="row">
	  <strong>Company Address:</strong>
	  <br>
	  <textarea name="compAddress" cols="50" rows="3"></textarea>
	  <br>
	</div>
	
	<div class="row">
	  <label for="compEmail"><strong>Company Email:</strong></label><br>
	  <input type="text" placeholder="Enter Email Address" name="compEmail" required>
	</div>
	
	<div class="row">
	  <label for="compNum"><strong>Company Number:</strong></label><br>
	  <input type="text" placeholder="Enter Phone Number" name="compNum" required>
	</div>
	
	<div class="row">
	  <label for="compPassword"><strong> Password: </strong></label><br>
      <input type="password" placeholder="Password" name="password"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one 
        uppercase and lowercase letter, and at least 8 or more characters" required>
	</div>
	
	<div class="row">
	  <label for="compPassword1"><strong>Re-Enter Password:</strong></label><br>
	  <input type="password" placeholder="Re-Enter Password" name="password" required>
	</div>
	
	
	<div class="row">
	  <strong>Company Bio:</strong>
	  <br>
	  <textarea name="CompanyDescription" cols="50"></textarea>
	  <br>
	</div>
          
    <div class="row">
	  <label for="empCount"><strong>Number of Employees:</strong></label><br>
	  <input type="text" placeholder="Enter Number of Employees" name="empCount" required>
	</div>

	<div class="row">
	  <input type="submit" class="btn btn-outline-success" value="Submit"/>
	</div>
  </div>
</form>	
</body>
</html>