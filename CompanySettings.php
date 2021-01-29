<?php 
 session_start();
 $_SESSION['idToUse'] = $_SESSION['compID'];
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Company Settings </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:255px">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
	  <?php echo "<a class='active' href='CompanyPage.php?compID=" . $_SESSION['compID'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>"; ?>
      </li>
    </ul>
	</div>
	<ul class="navbar-nav mr-auto">
	<li class="nav-item">
	<i><image src="images/icon.PNG" style="width:100px;height:100px;"></i>
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
			<a href="CreateVacancy.php"><button type="button" class="btn btn-outline-secondary">Create Vacancy</button></a>
		  </li>
		  <li>
			<a href="DeleteVacancies.php"><button type="button" class="btn btn-outline-secondary">Delete Vacancies</button></a>
		  </li>
		  <li>
			<?php echo "<a href='EditCompanyDetails.php?compID=" . $_SESSION['compID'] . "" . "'><button type='button' class='btn btn-outline-secondary'>Edit Company Details</button></a>";?>
		  </li>
    </div>
</body>