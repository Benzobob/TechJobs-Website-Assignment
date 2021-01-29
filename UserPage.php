<?php 
	include "config/connection.php";
	session_start();
	$companyView = 0;
	if(isset($_REQUEST['id'])){
		if(is_numeric($_REQUEST['id'])){
			$uid  = $_REQUEST['id'];
			$sql  		= "SELECT * FROM Users WHERE UserID= $uid";
			$sql2 		= "SELECT * FROM UserLogins WHERE UserID= $uid";
			$sql3		= "SELECT LinkToCode FROM UserProjects WHERE UserID= $uid";
			$sql4		= "SELECT AcademicDegrees.ADTitle, AcademicDegrees.ADDescription, UserDegrees.DateObtained FROM AcademicDegrees INNER JOIN UserDegrees ON AcademicDegrees.ADID=UserDegrees.ADID WHERE UserID= $uid";
			$sql7		= "SELECT * FROM WorkHistory WHERE UserID = $uid";
			$sql6 		= "SELECT STitle FROM Skills WHERE SID IN( SELECT SID FROM UserSkills WHERE UserID = $uid)";
			
			$result7 	= mysqli_query($conn,$sql7);
			$result6 	= mysqli_query($conn,$sql6);
			$result  	= mysqli_query($conn,$sql);
			$result2 	= mysqli_query($conn,$sql2);
			$result3 	= mysqli_query($conn,$sql3);
			$result4 	= mysqli_query($conn,$sql4);
			
			$row 		= mysqli_fetch_assoc($result);
			$row2		= mysqli_fetch_assoc($result2);
			$row3		= mysqli_fetch_assoc($result3);
			$row4		= mysqli_fetch_assoc($result4);
			$row7		= mysqli_fetch_assoc($result7);
			$row6		= mysqli_fetch_assoc($result6);
			
			$bool = true;
			if($row2['Banned'] =='1')
				$bool= false;
		}
	}
			

	if(isset($_SESSION['id'])) {
		$uid1 = $_SESSION['id'];
		$sql5		= "SELECT CStatus FROM Connections WHERE (UserID1 = $uid OR UserID1 = $uid1) AND (UserID2 = $uid OR UserID2 = $uid1)";
			
		$result5 	= mysqli_query($conn,$sql5);
		$row5		= mysqli_fetch_assoc($result5);
			
			if($row5['CStatus'] != 2){
				$friends = 0;
			}
			else{
				$friends = 1;
			}
	}
	else if(isset($_SESSION['compID'])){
		$friends = 1;
		$uid = 0;
		$companyView = 1;
	}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Create New User </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/UserPageStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>



<nav class="navbar navbar-expand-sm">
   
	<div class="d-inline-block" style="width:290px">
	  <?php 
	if($companyView == 1){
		echo "<a class='active' href='CompanyPage.php?compID=" . $_SESSION['compID'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
	}
	else if(isset($_SESSION['id'])){
		if($uid == $_SESSION['id']){
			echo "<a href='AccountSettings.php'><i><image src='images/settings.png' style='width:100px;height:100px;'></i></a>";
		}
		else{
			echo "<a class='active' href='UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>";
		}
	}
  ?>
	
	</div>


	<div class="d-inline-block">
	<?php
	if($companyView == 1){
		echo "<i><image src='images/icon.PNG' style='width:100px;height:100px;'></i>";
	}
	else{
		echo "<a href='HomePage.php'><i><image src='images/icon.PNG' style='width:100px;height:100px;'></i></a>";
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
      <h1><?php echo $row['Firstname']. " ". $row['Surname'];?></h1>
  </div>
  <div class="row1">
	<h3><?php if($row['Status'] == 'unemployed'){echo "Unemployed";}
			else{echo "Employed";}//Capitalizing the first letter?>
	</h3>
  </div>
  <?php 
  if(isset($_SESSION['id']))
  {
	if($uid != $_SESSION['id'] && $row5['CStatus'] == 0)
	{
		$_SESSION['id2'] = $uid;
		echo "<div class='row1'>";
		echo "<a href='AddConnection.php'><button type='button' class='btn btn-outline-success'>Add Connection</button></a>";
		echo "</div>";
	}
	else if($uid != $_SESSION['id'] && $row5['CStatus'] == 1 && $uid1 == $_SESSION['id']){
		echo "<div class='row1'>";
		echo "Friend Request Pending.";
		echo "</div>";
	}
	else if($uid != $_SESSION['id'] && $row5['CStatus'] == 3){
		echo "<div class='row1'>";
		echo "Friend Request Declined.";
		echo "</div>";
	}
  }
  ?>
  
  
<?php 
if(isset($_SESSION['id'])){
if($friends == 1 || $uid == $_SESSION['id']){ ?>
  <div class="row1">
	<h6><?php echo $row2['AccountEmail'] . "<br>" . $row['PhoneNum'];?>
	</h6>
  </div>
  
  <?php if($row['PersonalBio'] != NULL){ 
		echo "<hr>";
	  
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Personal Bio </h3>";
		echo "</div>";
		echo "</div>";
		echo "<div class='row'>";
		echo "<div class='col-2'></div>";
		echo "<div class='col-8'>";
	    echo $row['PersonalBio'];
		echo "</div>";
		echo "<div class='col-2'></div>";
		echo "</div>";
  }
  if($row6['STitle'] != NULL){ 
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Skills </h3>";
		echo "<ul class='list-group'>";
		$result6 = $conn->query($sql6);
		while($row6 = $result6->fetch_assoc()) {
	      echo  "<li class='list-group-item'>" . $row6['STitle'] . "</li>";
		}
		echo "</ul>";
		echo "<br>";
		echo "</div>";
		echo "</div>";
}
  if($row7['WHID'] != NULL){
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Job History </h3>";
	  
		$result7 = $conn->query($sql7);
		while($row7 = $result7->fetch_assoc()) {
			echo "<strong>Company:</strong><br>" . $row7['CompanyName'];
			echo "<br><strong>Job Description:</strong><br>" . $row7['JobDescription']; 
			echo "<br><strong>Start Date: </strong>" . $row7['StartDate'];
			echo "<br><strong>End Date: </strong>" . $row7['EndDate'];
			echo "<br><br>";
		}
		echo "</div>";
		echo "</div>";
	}
	if($row4['ADTitle'] != NULL){ 
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Academic Degrees </h3>";
		
		$result4 = $conn->query($sql4);
		while($row4 = $result4->fetch_assoc()) {
			echo "<strong>Title:</strong><br>" . $row4['ADTitle'];
			echo "<br><strong>Course Description:</strong><br>" . $row4['ADDescription']; 
			echo "<br><strong>Degree Obtained On : </strong><br>" . $row4['DateObtained'];
			echo "<br><br>";
		}
		echo "</div>";
		echo "</div>";
  }

  if($row3 != null){
		echo "<hr>";
  
		echo "<div class='row'>";
	
		$result3 = $conn->query($sql3);
		echo"<div class='col-3'></div><div class='col-6'><h3> Personal Projects </h3>";
		while($row3 = $result3->fetch_assoc()) {
	      echo "<a href=" . $row3['LinkToCode'] . ">" .$row3['LinkToCode'] . "</a>"; 
		  echo "<br>";
		}
		echo "</div>";
		echo "</div>";
	}
	?>
  
<?php } 
}
else if(isset($_SESSION['compID'])){ ?>
	<div class="row1">
	<h6><?php echo $row2['AccountEmail'] . "<br>" . $row['PhoneNum'];?>
	</h6>
  </div>
  <?php if($row['PersonalBio'] != NULL){ 
		echo "<hr>";
	  
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Personal Bio </h3>";
		echo "</div>";
		echo "</div>";
		echo "<div class='row'>";
		echo "<div class='col-2'></div>";
		echo "<div class='col-8'>";
	    echo $row['PersonalBio'];
		echo "</div>";
		echo "<div class='col-2'></div>";
		echo "</div>";
  }
  if($row6['STitle'] != NULL){ 
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Skills </h3>";
		echo "<ul class='list-group'>";
		$result6 = $conn->query($sql6);
		while($row6 = $result6->fetch_assoc()) {
	      echo  "<li class='list-group-item'>" . $row6['STitle'] . "</li>";
		}
		echo "</ul>";
		echo "<br>";
		echo "</div>";
		echo "</div>";
}
  if($row7['WHID'] != NULL){
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Job History </h3>";
	  
		$result7 = $conn->query($sql7);
		while($row7 = $result7->fetch_assoc()) {
			echo "<strong>Company:</strong><br>" . $row7['CompanyName'];
			echo "<br><strong>Job Description:</strong><br>" . $row7['JobDescription']; 
			echo "<br><strong>Start Date: </strong>" . $row7['StartDate'];
			echo "<br><strong>End Date: </strong>" . $row7['EndDate'];
			echo "<br><br>";
		}
		echo "</div>";
		echo "</div>";
	}
	if($row4['ADTitle'] != NULL){ 
		echo "<hr>";
		echo "<div class='row'>";
		echo "<div class='col-3'></div>";
		echo "<div class='col-6'>";
		echo "<h3> Academic Degrees </h3>";
		
		$result4 = $conn->query($sql4);
		while($row4 = $result4->fetch_assoc()) {
			echo "<strong>Title:</strong><br>" . $row4['ADTitle'];
			echo "<br><strong>Course Description:</strong><br>" . $row4['ADDescription']; 
			echo "<br><strong>Degree Obtained On : </strong><br>" . $row4['DateObtained'];
			echo "<br><br>";
		}
		echo "</div>";
		echo "</div>";
  }

  if($row3 != null){
		echo "<hr>";
  
		echo "<div class='row'>";
	
		$result3 = $conn->query($sql3);
		echo"<div class='col-3'></div><div class='col-6'><h3> Personal Projects </h3>";
		while($row3 = $result3->fetch_assoc()) {
	      echo "<a href=" . $row3['LinkToCode'] . ">" .$row3['LinkToCode'] . "</a>"; 
		  echo "<br>";
		}
		echo "</div>";
		echo "</div>";
	}
	?>
<?php } ?>
</div>
<?php else : ?>
	<div class="row">
	<div class="col-4"></div>
	<div class="col-4">
	<h1>This User Has Been Banned.</h1>
	</div>
	</div>
	<?php endif; ?>
</body>
</html>