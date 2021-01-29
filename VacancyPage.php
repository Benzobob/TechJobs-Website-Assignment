<?php 
	include "config/connection.php";
	session_start();
	if(isset($_REQUEST['vid'])) {
		if(is_numeric($_REQUEST['vid'])){
			$vid  = $_REQUEST['vid'];
			$sql  = "SELECT * FROM Vacancies WHERE VID = $vid";
			$sql2 = "SELECT * FROM Companies WHERE CompanyID IN(SELECT CompanyID FROM Vacancies WHERE VID = $vid)";
			
		    $result  	= mysqli_query($conn,$sql);
			$result2 	= mysqli_query($conn,$sql2);

			
			$row 		= mysqli_fetch_assoc($result);
			$row2		= mysqli_fetch_assoc($result2);
		}
	}
			
	?>

	
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Vacancy</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/VacancyPage.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>


<nav class="navbar navbar-expand-sm">
   
	<div class="d-inline-block" style="width:278px">
	<?php 
	  if(isset($_SESSION['id'])){
		 echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	  }
	  else if(isset($_SESSION['compID'])){
		  echo "<a class='active' href='CompanyPage.php?compID=" . $_SESSION['compID'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	  }
  ?>
	</div>


	<div class="d-inline-block">
	<?php
	if(isset($_SESSION['id'])){
		 echo "<a href='HomePage.php'><i><image src='images/icon.PNG' style='width:100px;height:100px;'></i></a>";
	  }
	  else if(isset($_SESSION['compID'])){
		  echo "<i><image src='images/icon.PNG' style='width:100px;height:100px;'></i>";
	  }
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

<div class="container">
  <div class="row">
    <div class="col-4"></div>
	<div class="col-4">
      <h3> Company </h3><br>
	  <?php echo "<a href='CompanyPage.php?compID=" . $row['CompanyID'] . "'><h1>" . $row2['CompanyName'] . "</h1></a>"; ?>
	</div>
  </div>
  <hr>
  <div class="row">
    <div class="col-4"></div>
	<div class="col-4">
	  <h4> Vacancy Title </h4><br>
	  <?php echo "<h2>" . $row['VTitle'] . "</h2>"; ?>
	</div>
  </div>
  <hr>
  <div class="row">
    <div class="col-6">
	  <h4> Job Description </h4>
	  <?php echo "<p>" . $row['VDescription'] . "</p>"; ?>
	</div>
	<div class="col-6">
	  <h4> Required Experience </h4>
	  <?php echo "<p>" . $row['RequiredExp'] . "</p>"; ?>
	</div>
  </div>
  <hr>
  <div class="row">
    <div class="col-3"></div>
	<div class="col-6">
	  <h4> Skills Required </h4>
	  <ul class="list-group">
	  <?php
	     $sql3 = "SELECT * FROM Skills WHERE SID IN(SELECT SID FROM SkillsForVacancy WHERE VID = $vid)";
	     $result3 = $conn->query($sql3);
	     while($row3 = $result3->fetch_assoc()) {
	      echo  "<li class='list-group-item'>" . $row3['STitle'] . "</li>";
		}
		echo "</ul><br>";
		?>
	</div>
  </div>
</div>
</body>
</html>
	