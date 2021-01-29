<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update Academic Degrees </title>
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

<h2><strong>Update Academic Degrees</strong></h2>
<h2><a href="DeleteDegrees.php"><button type="button" class="btn btn-outline-secondary">Delete Degrees</button></a></h2>
<hr> 

<?php
if($_POST){
include_once 'config/database.php';
include 'objects/AcademicDegree.php';
    
$database = new Database();
$db = $database->getConnection();
$AcademicDegree = new AcademicDegree($db);

$AcademicDegree->ADTitle=$_POST['AD_Title'];
$AcademicDegree->ADDescription=$_POST['AD_Description'];
$AcademicDegree->DegreeDate=$_POST['dateObtained'];
$AcademicDegree->createDegree();
$AcademicDegree->UserID=$_SESSION['id'];
$AcademicDegree->insertDegree();

echo '<meta http-equiv="refresh" content="3; url=UserPage.php?id=' . $_SESSION['id'] . '>';
}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="container">
  <div class="row">
	<strong> Academic Degree Title: </strong><br>
	<input type="text" placeholder="Title" name="AD_Title">
  </div>
  <div class="row">
	<strong> Description Of Degree: </strong>
	<br>
	<textarea name="AD_Description" cols="50"></textarea>
	<br>
  </div>
  <div class="row">
    <strong> Date Of Completion: </strong><br>
	<input type="date" name="dateObtained">
  </div>
  <br>
  <div class="row">
    <input type="submit" class="btn btn-outline-success" value="Submit"/>
  </div>
</div>
</form>
</body>
</html>