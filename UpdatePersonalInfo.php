<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update User Info </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/UpdateStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

<body>
<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:255px">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
	  <?php echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>"; ?>
      </li>
    </ul>
	</div>
	<ul class="navbar-nav mr-auto">
	<li class="nav-item">
	<a href="HomePage.php"><i><image src="images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</li>
	</ul>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="SearchResult.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<h2><strong> Update Personal Information</strong> </h2>

<?php
if($_POST){
include_once 'config/database.php';
include_once 'objects/user.php';
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->PhoneNum=$_POST['phoneNum'];
$user->Status=$_POST['status'];
$user->PersonalBio=$_POST['personalBio'];
$user->Projects=$_POST['projects'];
$user->UserID=$_SESSION['id'];
$user->updatePersonal();
echo '<meta http-equiv="refresh" content="3; url=UserPage.php?id=' . $_SESSION['id'] . '>';
}
?>

      
<?php
//$dsn = 'mysql:host=sql2.freesqldatabase.com;dbname=sql2227593';
//$user = 'sql2227593';
//$password = 'tG3*zC3*';
//$conn = new PDO($dsn, $user, $password);
include_once 'config/database.php';
$database1 = new Database();
$conn = $database1->getConnection();
      
$sql = "SELECT PhoneNum, Status, PersonalBio
                FROM Users
                WHERE UserID = :UserID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UserID', $_SESSION['id']);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            echo "error";
            return false;
        }
$rPhoneNumber = $row['PhoneNum'];
$rStatus = $row['Status'];
$rBio = $row['PersonalBio'];
$sql = "SELECT PhoneNum, Status, PersonalBio
                FROM Users
                WHERE UserID = :UserID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UserID', $_SESSION['id']);
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
	  <strong> Phone Number: </strong><br>
	  <input type="text" placeholder="Update Phone Number" <?php if(isset($rPhoneNumber)){echo "value=\"$rPhoneNumber\"";} ?> name="phoneNum">
	</div>
	<div class="col-6">
	  <strong> Employment Status: </strong><br>
        
        
        
        <?php if(isset($rStatus) and $rStatus == "unemployed"){
            echo '<select name="status"> 
            <option value="unemployed">Unemployed</option>
	    <option value="employed">Employed</option>
	  </select>';
        }else{
        echo '<select name="status"> 
            <option value="employed">Employed</option>
	    <option value="unemployed">Unemployed</option>
	  </select>';
    } ?>
<!--
	  <select name="status"> 
	    <option value="employed">Employed</option>
		<option value="unemployed">Unemployed</option>
	  </select>
-->
	</div>
  </div>
  <br>
  <div class="row">
    <div class="col-6">
	  <strong> Personal Bio: </strong>
	  <br>
	  <textarea name="personalBio" cols="50" ><?php if(isset($rBio)){echo $rBio;} ?></textarea>
	  <br>
	</div>
	<div class="col-6">
	  <strong> Link To Project: </strong><br>
	  <input type="text" placeholder="Link To Project" name="projects">
	  <br>
	</div>
  </div>
  <br>
  <div class="row">
    <input type="submit" class="btn btn-outline-success" value="Submit"/>
  </div>
</div>
</form>
</body>
</html>
  