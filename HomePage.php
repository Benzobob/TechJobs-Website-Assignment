<?php
session_start();
include "config/connection.php";
$UID = $_SESSION['id'];
$sql = "SELECT * FROM Vacancies WHERE VID IN (SELECT VID FROM SkillsForVacancy WHERE SID IN(SELECT SID FROM UserSkills WHERE UserID = $UID))";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> HomePage </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/ChangeDisplay.css">
  <link rel="stylesheet" href="css/HomePageStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
   
	<div class="d-inline-block" style="width:270px">
	<?php 
	if(isset($_SESSION['id'])){
		echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	}
  ?>
	
	</div>
	<div class="d-inline-block">
	<?php
		echo "<a href='HomePage.php'><i><image src='images/icon.PNG' style='width:100px;height:100px;'></i></a>";
		?>
	</div>
	
	
	<div class="d-inline-block" id="navbarSupportedContent">
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="SearchResult.php" method="get">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  </div>
  
</nav>

    <br>
    <div class="container">
        <div class="icon-bar">
            <a class="active" href="HomePage.php" title="Reload HomePage"><i class="fa fa-home"></i></a>
            <a href="AccountSettings.php" title="Go to Account Settings"><i class="fa fa-gear" ></i></a>	
            <a href="Logout.php"          title="Logout"><i class="fa fa-share-square-o" ></i></a>
        </div>
    </div>
    <hr>
    <div class="vaclist">
        <h3> Related Vacancies</h3>
         <ul class="list-group">
		 <?php 
		 while($row = $result->fetch_assoc()) {
	      echo  "<a href='VacancyPage.php?vid=" . $row['VID'] . "'><li class='list-group-item'>" . $row['VTitle'] ."</li></a>";
		}
		?>
        </ul>
    </div>
</body>
</html>