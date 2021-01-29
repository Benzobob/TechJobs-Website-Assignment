<?php 
session_start();
if(isset($_SESSION['id'])){
	 if($_SESSION['id'] == 1){
		if(isset($_GET['id'])){
		$_SESSION['idToUser'] = $_GET['id'];
	}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update User Login Details </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/NavBarStyle2.css">
  <link rel="stylesheet" href="../css/UpdateStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

<body>
<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:255px">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
	  <?php echo "<a class='active' href='../UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>"; ?>
      </li>
    </ul>
	</div>
	<ul class="navbar-nav mr-auto">
	<li class="nav-item">
	<a href="../HomePage.php"><i><image src="../images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</li>
	</ul>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="../SearchResult.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<h2><strong> Update User's Login Information</strong> </h2>

<?php
if($_POST){
include_once '../config/database.php';
include_once '../objects/user.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->AccountEmail=$_POST['AccountEmail'];
$user->Password=$_POST['Password'];
$user->UserID=$_SESSION['idToUser'];
$user->updateUserLogins();
//header('refresh:1; url= ../HomePage.php');
}
?>

      
<?php
include_once '../config/database.php';
$database1 = new Database();
$conn = $database1->getConnection();
      
$sql = "SELECT AccountEmail, Password
                FROM UserLogins
                WHERE UserID = :UserID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UserID', $_SESSION['idToUser']);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            echo "error";
            return false;
        }
$rAccountEmail 	= $row['AccountEmail'];
$rPassword 		= $row['Password'];

$sql = "SELECT AccountEmail, Password
                FROM UserLogins
                WHERE UserID = :UserID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UserID', $_SESSION['idToUser']);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            echo "error";
            return false;
        }
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="container">
	
	<div class="row">
    <div class="col-6">
	  <strong> Account Email: </strong><br>
	  <input type="text" placeholder="Update Email" <?php if(isset($rAccountEmail)){echo "value=\"$rAccountEmail\"";}?> name="AccountEmail">
	</div>
	<div class="col-6">
	  <strong> Password: </strong><br>
	  <input type="password" placeholder="Update Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" <?php if(isset($rPassword)){echo "value=\"$rPassword\"";} ?> name="Password">
	</div>
	</div>
  <br>
  <div class="row">
    <input type="submit" class="btn btn-outline-success" value="Submit"/>
  </div>
</div>
</form>
<?php }
 }
 else{
	 echo "Log In As An Admin To Access This Page";
}?>
</body>
</html>