<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update Work History </title>
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
      
    
<?php
if($_POST){
include_once 'config/database.php';
include 'objects/user.php';
    
$database = new Database();
$db = $database->getConnection();
$User = new user($db);

$User->UserID=$_SESSION['id'];
$User->EmployerName=$_POST['companyName'];
$User->JobDescription=$_POST['jobDescription'];
$User->JobStartDate=$_POST['startDate'];
$User->JobEndDate=$_POST['endDate'];
$User->addEmployment();

echo "<meta http-equiv='refresh' content='3; url=UserPage.php?id=". $_SESSION['id'] . ">";
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<h2><strong>Update Work History</strong></h2>
<h2><a href="DeleteJobs.php"><button type="button" class="btn btn-outline-secondary">Delete Jobs</button></a></h2>
<hr> 

<div class="container">
  <div class="row">
	<div class="col-6">
	  <strong> Company Name: </strong><br>
	  <input type="text" placeholder="Company Name" name="companyName">
	</div>
	<div class="col-6">
	  <strong> Job Description: </strong><br>
	  <textarea name="jobDescription" cols="25">
	  </textarea>
	  <br>
	</div>
  </div>
  <br>
  <div class="row">
	<div class="col-6">
	  <strong> Start Date: </strong><br>
	  <input type="date" name="startDate">
	</div>
	<div class="col-6">
	  <strong> End Date: </strong><br>
	  <input type="date" name="endDate">
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
  