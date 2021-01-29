<?php
	session_start();
	?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Log In </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Styles.css">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php
 if($_POST){
	include_once "config/database.php";
	include_once "objects/user.php";
	
	try{
		$database = new Database();
		$db = $database->getConnection();
	
		$user = new User($db);
	
		$user->AccountEmail=$_POST['email'];
		
		$email_exist = $user->emailExist();
		$user->setSessionVariable();
        if($user->Banned == 1)
            echo 'Banned';
        elseif($email_exist && $_POST['password'] == $user->Password && $user->AdminStatus == 1){
            echo '<meta http-equiv="refresh" content="2; url=AdminPage.php">';
        }
        elseif($email_exist && $_POST['password'] == $user->Password){
        echo "<div class='alert alert-info'>";
		echo 'Successfully logged in. Redirecting to profile page. <meta http-equiv="refresh" content="2; url=UserPage.php?id=' . $_SESSION['id'] . '">';
        echo "</div>";
    	}
    	else{
    		echo "<div class='alert alert-info'>
            	<strong>Wrong email or password. Please try again.</strong>
        		</div>";
   		}
   	}

   catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
    }
}    
?>


<nav class="navbar navbar-expand-sm">
<div class="d-inline-block" style="width:100px"></div>

        <div class ="d-inline-block">
                <a href="Intro.php"><i><image src="images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</div>
	
	<div class="d-inline-block">
    <a class="info" href="CreateUser.php" style="font-size:15px;width:100px;"><i><p1>Don't Have An Account Yet?</p1></i></a> 
  </div>
</nav>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="container">
  <div class="row1">
    <h3> Log In To Your Account</h3>
	</div>
	
	<div class="row">
	  <label for="email"><strong>Email Address:</strong> </label><br>
	  <input type="text" placeholder="Enter Email Address" name="email" required>  
	</div>
	
	<div class="row">
	  <label for="password"><strong>Password:</strong> </label><br>
	  <input type="password" placeholder="Enter Password" name="password" required>
	</div>
	
	<div class="row">
	  <input type='submit' class='btn btn-outline-success' value='Log In' />
	</div>
  </div>
</form>
</body>
</html>