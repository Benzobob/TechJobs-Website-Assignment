<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Search Results </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>

<nav class="navbar navbar-expand-sm">
   
	<div class="d-inline-block" style="width:280px">
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

 <script type="text/javascript">
      function BanUser(x)
      {
            if (confirm("Ban User?"))
			{
				var str1 = "Admin/BanUser.php?id=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function UnbanUser(x)
      {
            if (confirm("Revoke Ban On User?"))
			{
				var str1 = "Admin/UnbanUser.php?id=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function DeleteUser(x)
      {
			if (confirm("Delete User?"))
			{
				var str1 = "Admin/DeleteUser.php?id=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function EditUser(x)
      {
			if (confirm("Edit User?"))
			{
				var str1 = "Admin/UpdateUserInfoPage.php?id=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function DeleteCompany(x)
      {
			if (confirm("Delete Company?"))
			{
				var str1 = "Admin/DeleteCompany.php?compID=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function BanCompany(x)
      {
			if (confirm("Ban Company?"))
			{
				var str1 = "Admin/BanCompany.php?compID=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function UnbanCompany(x)
      {
			if (confirm("Revoke Ban On Company?"))
			{
				var str1 = "Admin/UnbanCompany.php?compID=";
				var page = str1.concat(x);
				location.href=page;
			} 
			else{
				location.reload();
			}
      }
	  
	  function EditCompany(x)
      {
		  if (confirm("Edit This Company Page?"))
			{
				var str1 = "EditCompanyDetails.php?compID=";
				var page = str1.concat(x);
				location.href=page;
			}
			
			
			else{
				location.reload();
			}
      }
	  
	  
	  function DeleteVacancy(x)
      {	
			if (confirm("Delete Vacancy?"))
			{
				var str1 = "Admin/DeleteVacancy.php?vid=";
				var page = str1.concat(x);
				location.href=page;
			}
			else{
				location.reload();
			}
      }
  </script>


<?php
include 'config/connection.php';

if(isset($_GET['query'])){
$query = $_GET['query'];
if($query != '')
{
	$sql  = "SELECT * FROM Users JOIN UserLogins ON Users.UserID=UserLogins.UserID WHERE Users.Firstname LIKE '%" . $query . "%' OR Users.Surname LIKE '%" .$query ."%'";
	$sql1 = "SELECT * FROM Companies JOIN CompanyLogins ON Companies.CompanyID=CompanyLogins.CompanyID WHERE CompanyName LIKE '%" . $query . "%'";
	$sql2 = "SELECT VID, VTitle FROM Vacancies WHERE VTitle LIKE '%" . $query . "%'";
	
	$result = $conn->query($sql);
	$result1 = $conn->query($sql1);
	$result2 = $conn->query($sql2);
	$numUsers = $result->num_rows;
	$numCompanies = $result1->num_rows;
	$numVacancies = $result2->num_rows;
	$TotalNum = $numVacancies + $numCompanies + $numUsers;
	echo "<div class='container'><table class='table table-striped'>";
	if ($TotalNum > 0) {
		$count_rows = mysqli_num_rows($result);
		echo $TotalNum . ' search results found.';
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td> <a href='UserPage.php?id=" . $row['UserID'] . "'> User: ". $row["Firstname"]. " ". $row["Surname"] . "</a></td>";
			if(isset($_SESSION['id'])){
				if($_SESSION['id'] == 1){
					if($row['Banned'] == 0){
						echo "<td scope='col-3'><a style='cursor: pointer;' onclick='BanUser(" . $row['UserID'] . ")'><i class='material-icons'>block</i></a></td>";}
					else{
						echo "<td scope='col-3'><a style='cursor: pointer;' onclick='UnbanUser(" . $row['UserID'] . ")'><i class='material-icons'>input</i></a></td>";}
					echo "<td scope='col-3'><a style='cursor: pointer;text-decoration: none;color: black;' onclick='EditUser(" . $row['UserID'] . ")'><i class='material-icons'>border_color</i></a></td>";
					echo "<td scope='col-3'><a style='cursor: pointer;' onclick='DeleteUser(" . $row['UserID'] . ")'><i class='material-icons'>delete</i></a></td>";
				}
			}
			echo "</tr>";
		}
		
		while($row = $result1->fetch_assoc()) {
			
			echo "<tr>";
			echo "<td> <a href='CompanyPage.php?compID=" . $row['CompanyID'] . "'> Company: ". $row["CompanyName"]. "</a></td>";		
			if(isset($_SESSION['id'])){	
				if($_SESSION['id'] == 1){
					if($row['Banned'] == 0){
						echo "<td scope='col-3'><a style='cursor: pointer;' onclick='BanCompany(" . $row['CompanyID'] . ")'><i class='material-icons'>block</i></a></td>";}
					else{
						echo "<td scope='col-3'><a style='cursor: pointer;' onclick='UnbanCompany(" . $row['CompanyID'] . ")'><i class='material-icons'>input</i></a></td>";}
					echo "<td scope='col-3'><a onclick='EditCompany(" . $row['CompanyID'] . ")' style='cursor: pointer;text-decoration: none;color: black;' ><i class='material-icons'>border_color</i></a></td>";
					echo "<td scope='col-3'><a style='cursor: pointer;' onclick='DeleteCompany(" . $row['CompanyID'] . ")'><i class='material-icons'>delete</i></a></td>";	
				}
			}
			echo "</tr>";
		}
		while($row = $result2->fetch_assoc()) {
			echo "<tr>";
			echo "<td> <a href='VacancyPage.php?vid=" . $row['VID'] . "'> Vacancy: ". $row["VTitle"]. "</a></td>";		
			if(isset($_SESSION['id'])){	
				if($_SESSION['id'] == 1){
					echo "<td> </td>";
					echo "<td> </td>";
					echo "<td scope='col-3'><a style='cursor: pointer;' onclick='DeleteVacancy(" . $row['VID'] . ")'><i class='material-icons'>delete</i></a></td>";
				}
			}
			echo "</tr>";
		}
		echo "</table></div>";
	}

	else {
		echo "No Matching Results Found.";
	}
  }
}
else
{
	echo "No Input Received, Try Again!";
}
$conn->close();
?> 