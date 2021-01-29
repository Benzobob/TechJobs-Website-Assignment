<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Create New User </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/Styles.css">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
<!--  <link rel="stylesheet" href="css/UpdateSkillsStyle.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    
<body>

<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:300px">
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

<?php
// include classes
include_once 'config/database.php';
include_once 'objects/Vacancy.php';

    // if form was posted
if($_POST){
 
    $database = new Database();
    $db = $database->getConnection();
    $vacancy = new Vacancy($db);
    $vacancy->CompanyID = $_SESSION['compID'];
    $vacancy->VTitle = $_POST['jobTitle'];
    $vacancy->VDescription = $_POST['jobDescription'];
    $vacancy->RequiredExp = $_POST['experience'];
        
    if($vacancy->createVacancy()){
        $_SESSION['VacID'] = $vacancy->VacID;
        echo "<div class='alert alert-info'>";
//        echo 'Successfully created vacancy. Redirecting to company page. <meta http-equiv="refresh" content="2; url=CompanyPage.php?compID=' . $_SESSION['compID'] . '">';
        echo 'Vacancy successfully created. Please add skills required for vacancy. <meta http-equiv="refresh" content="2; url=SkillsForVacancy.php">';
        echo "</div>";
    }else{
 		 echo "<div class='alert alert-danger' role='alert'>Unable to create vacancy. Please try again.</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="container">
  <div class="row1">
    <h3> Find Employees That <br>
	Best Suit You!
	</h3>
	</div>
	
	<div class="row">
	  <label for="jobTitle"><strong>Job Title:</strong> </label><br>
	  <input type="text" placeholder="Enter Job Title" name="jobTitle" required>  
	</div>
	
	<div class="row">
	 <strong>Job Description:</strong>
	  <br>
	  <textarea name="jobDescription" cols="50"></textarea>
	  <br>
	</div>
	
	<div class="row">
	  <label for="experience"><strong>Required Experience:</strong></label><br>
	  <input type="text" placeholder="Enter Required Experience" name="experience">
	</div>
	
	<div class="row">
	  <input type="submit" class="btn btn-outline-success" value="Submit"/>
	</div>
  </div>
</form>	
</body>
</html>