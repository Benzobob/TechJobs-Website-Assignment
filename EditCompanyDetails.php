<?php
	include "config/connection.php";
	session_start();
	if(isset($_GET['compID'])){
		$_SESSION['idToUse'] = $_GET['compID'];
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Edit Company </title>
  <link rel="stylesheet" href="css/Styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/ChangeDisplay.css">
  <link rel="stylesheet" href="css/HomePageStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:255px">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
	 <?php 
	  if(isset($_SESSION['id'])){
		 echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	  }
	  else if(isset($_SESSION['compID'])){
		  echo "<a class='active' href='CompanyPage.php?compID=" . $_SESSION['compID'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	  }
  ?>
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

$showPage = 0;
	if(isset($_SESSION['idToUse']))
	{
		if($_POST)
		{
			include_once 'config/database.php';
			include_once 'objects/Company.php';
			$database = new Database();
			$db = $database->getConnection();
			$company = new Company($db);

			$company->Name=$_POST['compName'];
			$company->Address=$_POST['compAddress'];
			$company->Email=$_POST['compEmail'];
			$company->CompanyDescription=$_POST['CompanyDescription'];
			$company->EmployeeCount=$_POST['empCount'];
			$company->ContactNum=$_POST['contactNum'];
			$company->CompanyID=$_SESSION['idToUse'];
			if($company->updateDetails()){
				echo 'Successfully updated company details. Redirecting to company page. <meta http-equiv="refresh" content="2; url=CompanyPage.php?compID=' . $_SESSION['idToUse'] . '">';
			}
		}

			include_once 'config/database.php';
			$database1 = new Database();
			$conn = $database1->getConnection();
				  
			$sql = "SELECT *
					FROM Companies
					WHERE CompanyID = :CompanyID";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':CompanyID', $_SESSION['idToUse']);
			if($stmt->execute()){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
			}else{
				echo "error";
				return false;
			}
			$CompanyName = $row['CompanyName'];
			$Address = $row['Address'];
			$CompanyEmail = $row['CompanyEmail'];
			$CompanyDescription = $row['CompanyDescription'];
			$ContactNum = $row['ContactNum'];
			$Employees = $row['Employees'];
	}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="container">
  <div class="row1">
    <h3> Edit Company Details
	</h3>
	</div>
	
	<div class="row">
	  <label for="compName"><strong>Company Name:</strong> </label><br>
	  <input type="text" placeholder="Enter Company Name" name="compName" <?php if(isset($CompanyName)){echo "value=\"$CompanyName\"";} ?>required>  
	</div>
      
    <div class="row">
	  <strong>Company Address:</strong>
	  <br>
	  <textarea name="compAddress" cols="50"><?php if(isset($Address)){echo $Address;} ?></textarea>
	  <br>
	</div>
	
	<div class="row">
	  <label for="compEmail"><strong>Company Email:</strong></label><br>
	  <input type="text" placeholder="Enter Email Address" name="compEmail" <?php if(isset($CompanyEmail)){echo "value=\"$CompanyEmail\"";} ?>required>
	</div>
	
	<div class="row">
	  <strong>Company Bio:</strong>
	  <br>
	  <textarea name="CompanyDescription" cols="50" white-space="normal"><?php if(isset($CompanyDescription)){echo $CompanyDescription;}?></textarea>
	  <br>
	</div>
      
      
    <div class="row">
	  <label for="contactNum"><strong>Contact Number:</strong></label><br>
	  <input type="text" placeholder="Enter Contact Number" name="contactNum" <?php if(isset($ContactNum)){echo "value=\"$ContactNum\"";} ?> required>
	</div>
          
    <div class="row">
	  <label for="empCount"><strong>Number of Employees:</strong></label><br>
	  <input type="text" placeholder="Enter Number of Employees" name="empCount" <?php if(isset($Employees)){echo "value=\"$Employees\"";} ?> required>
	</div>

	<div class="row">
	  <input type="submit" class="btn btn-outline-success" value="Submit"/>
	</div>
  </div>
</form>      
</body>
</html>