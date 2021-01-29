<?php 
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Delete Degrees </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

<body>
<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:285px">
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

<script>
	function DeleteDegree(x)
      {	
			if (confirm("Delete This Degree?"))
			{
				var str1 = "DeleteDegreeForUser.php?adid=";
				var page = str1.concat(x);
				location.href=page;
			}
			else{
				location.reload();
			}
      }
  </script>

<div class="container">
  <div class="row">
    <div class="col-3"></div>
	<div class="col-6">
	<h3 style="text-align:center;">Job History</h3>
	<ul class="list-group">
		<?php 
		include "config/connection.php";
		$uid = $_SESSION['id'];
		//$sql  = "SELECT * FROM UserDegrees WHERE UserID = $uid";
		$sql = "SELECT AcademicDegrees.ADTitle, UserDegrees.ADID FROM AcademicDegrees INNER JOIN UserDegrees ON AcademicDegrees.ADID=UserDegrees.ADID WHERE UserID= $uid";
		$result = $conn->query($sql);
		echo "<div class='container'><table class='table table-striped'>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" .  $row['ADTitle'] .  "</td>";
			echo "<td><a style='cursor: pointer;' onclick='DeleteDegree(" . $row['ADID'] . ")'><i class='material-icons'>delete</i></a></td>";
		}
		echo "</tr>";
		?>
		<br>
	</div>
  </div>
</div>