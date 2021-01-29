<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Create New User </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Styles.css">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<nav class="navbar navbar-expand-sm">
<div class="d-inline-block" style="width:100px"></div>

        <div class ="d-inline-block">
                <a href="Intro.php"><i><image src="images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</div>
	
	<div class="d-inline-block">
    <a class="info" href="LogIn.php" style="font-size:15px;width:100px;"><i><p1>Already have an account?</p1></i></a> 
  </div>
</nav>

<?php
$page_title = "Create New User";
include "config/core.php";
//include_once "login_checker.php";
//include_once "layout_head.php";
// include classes
include_once 'config/database.php';
include_once 'objects/user.php';

    // if form was posted
if($_POST){
 
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
 
    // set user email to detect if it already exists
    $user->AccountEmail=$_POST['email'];
 
    // check if email already exists
    if($user->emailExist()){
        echo "<div class='alert alert-danger'>";
            // echo "The email you specified is already registered. Please try again or <a href='{$home_url}login'>login.</a>";
            echo 'The email you specified is already registered. Please try again or <a href="LogIn.php">login.</a>';
        echo "</div>";
    }
 
    else{
        // set values to object properties
        $user->Firstname=$_POST['firstname'];
		$user->Surname=$_POST['surname'];
		$user->AccountEmail=$_POST['email'];
		$user->Password=$_POST['password'];
		$user->AdminStatus=0;
		$user->Banned=0;
 
		// create the user
		if($user->create()){
 
    		echo "<div class='alert alert-info'>";
    		echo 'Successfully registered. Redirecting to personal info page. <meta http-equiv="refresh" content="3; url=UpdatePersonalInfo.php">';
 		   echo "</div>";
 
		    // empty posted values
 		   $_POST=array();
 
		}else{
 		   echo "<div class='alert alert-danger' role='alert'>Unable to register. Please try again.</div>";
		}
  	}
}
?>
<form action='CreateUser.php' method='post' id='register'>
<div class="container">
  <div class="row1">
    <h3> Join some of the best software<br>
		developers and companies worldwide
	</h3>
	</div>
	
	<div class="row">
	  <label for="firstname"><strong>Firstname:</strong> </label><br>
	  <input type="text" placeholder="Enter Firstname" name="firstname" required>  
	</div>
	
	<div class="row">
	  <label for="surname"><strong>Surname:</strong> </label><br>
	  <input type="text" placeholder="Enter Surname" name="surname" required>
	</div>
	
	<div class="row">
	  <label for="email"><strong>Email:</strong></label><br>
	  <input type="email" placeholder="Enter Email Address" name="email" required>
	</div>
	
	<div class="row">
	<label for="password"><strong>Password:</strong></label><br>
    <input type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
	</div>
	
	<div class="row">
	  <label for="password1"><strong>Re-Enter Password:</strong></label><br>
	  <input type="password" placeholder="Re-Enter Password" name="password" required>
	</div>
	
	<div class="row">
	  <input type="submit" class="btn btn-outline-success" value='Sign Up' />
	</div>
  </div>
</form>
</body>
</html>