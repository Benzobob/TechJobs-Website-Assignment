<?php 
 session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Create New User </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  
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

<br>
<div class="container">
  <div class="row">
    <div class="col-6">
		<ul>
		  <li>
			<a href="Logout.php"><button type="button" class="btn btn-outline-secondary">Log Out</button></a>
		  </li>
		  <li>
			<a href="Connections.php"><button type="button" class="btn btn-outline-secondary">Connections</button></a>
		  </li>
		  <li>
			<a href="UpdatePersonalInfo.php"><button type="button" class="btn btn-outline-secondary">Personal Info</button></a>
		  </li>
		  <li>
			<a href="UpdateWorkHistory.php"><button type="button" class="btn btn-outline-secondary">Work History</button></a>
		  </li>
		  <li>
			<a href="UpdateAcademicDegrees.php"><button type="button" class="btn btn-outline-secondary">Academic Degrees</button></a>
		  </li>
		  <li>
			<a href="UpdateUserSkills.php"><button type="button" class="btn btn-outline-secondary">User Skills</button></a>
		  </li>
    </div>
  </div>
</div>
</body>
</html>