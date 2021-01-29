<?php 
	include "config/connection.php";
	session_start();
	$userView = 0;
	if(isset($_REQUEST['compID'])) {
		if(is_numeric($_REQUEST['compID'])){
			$cid  = $_REQUEST['compID'];
		
			$sql  = "SELECT * FROM Companies WHERE CompanyID = $cid";
			$sql1 = "SELECT * FROM Vacancies WHERE CompanyID = $cid";
			$sql2 = "SELECT * FROM CompanyLogins WHERE CompanyID = $cid";
			
			$result  	= mysqli_query($conn,$sql);
			$result1 	= mysqli_query($conn,$sql1);
			$result2	= mysqli_query($conn,$sql2);
			
			$row 		= mysqli_fetch_assoc($result);
			$row1 		= mysqli_fetch_assoc($result1);
			$row2		= mysqli_fetch_assoc($result2);
			$bool = true;
			if($row2['Banned'] =='1')
				$bool= false;
		}
	}
	
	if(isset($_SESSION['id'])){
		$userView = 1;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Company Information </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/UserPageStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
   
	<div class="d-inline-block" style="width:305px">
	  <?php 
	if($userView == 1){
		echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	}
	else if(isset($_SESSION['compID'])){
		if($cid == $_SESSION['compID']){
			echo "<a href='CompanySettings.php'><i><image src='images/settings.png' style='width:100px;height:100px;'></i></a>";
		}
		else{
			echo "<a class='active' href='CompanyPage.php?compID=" . $_SESSION['compID'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
		}
	}
  ?>
	
	</div>


	<div class="d-inline-block">
	<?php
	if($userView == 1){
		echo "<a href='HomePage.php'><i><image src='images/icon.PNG' style='width:100px;height:100px;'></i></a>";
	}
	else{
		echo "<i><image src='images/icon.PNG' style='width:100px;height:100px;'></i>";
	}?>
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

        
	<?php if($bool) : ?>
    <div class="container">
        <div class="row1">
            <?php 
			echo "<h1>" . $row['CompanyName'] . "</h1>";?>
		</div>
		<div class="row1">
            <?php 
			echo "<h5>" . $row['CompanyEmail'] . "</h5>";?>
		</div>
		<div class="row1">
            <?php 
			echo "<h6>" . $row['ContactNum'] . "</h6>";?>
		</div>
			
        <hr>
        <!--Second Div for Company ID, text align left -->
        <div class="row">
                <div class="col-4">
                  <h3>Company Description</h3>
				  <?php echo "<p>" . $row['CompanyDescription'] . "</p>"; ?>
                </div>
                <div class="col-4">
                  <h3>Address</h3>
				  <?php echo "<p>" . $row['Address'] . "</p>"; ?>
                </div>
				<div class="col-4">
                  <h3>Number Of Employees:</h3>
				  <?php echo "<p>" . $row['Employees'] . "</p>"; ?>
                </div>
        </div>
        
<?php
if($row1['VTitle'] != NULL){ 
		echo "<hr>";
        
        echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
        echo "<h3>List Of Vacancies:</h3>";
		echo "<ul class='list-group'>";
		$result1 = $conn->query($sql1);
		while($row1 = $result1->fetch_assoc()) {
			echo  "<a href='VacancyPage.php?vid=" . $row1['VID'] . "'><li class='list-group-item'>" . $row1['VTitle'] ."</li></a>";
		}
        echo "</ul><br>";
        echo "</div>";
		echo "</div>";
        echo "<br><br>";
		}
        ?>
    </div>
	<?php else : ?>
	<div class="row">
	<div class="col-4"></div>
	<div class="col-4">
	<h1>This Company Has Been Banned.</h1>
	</div>
	</div>
	<?php endif; ?>

</body>
</html>