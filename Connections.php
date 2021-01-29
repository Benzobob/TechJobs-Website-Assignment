<?php 
 session_start();
 include 'config/connection.php';
		$UID  = $_SESSION['id'];
		$sql  = "SELECT * FROM Users WHERE UserID IN( SELECT UserID1 FROM Connections WHERE UserID2=$UID AND CStatus=1)";
		$sql1 = "SELECT * FROM Users WHERE UserID IN(SELECT UserID2 FROM Connections WHERE UserID1 = $UID AND CStatus=2)";
		$sql2 = "SELECT * FROM Users WHERE UserID IN(SELECT UserID1 FROM Connections WHERE UserID2 = $UID AND CStatus=2)";
		
		$result = $conn->query($sql) or die($conn->error);
		$result1 = $conn->query($sql1) or die($conn->error);
		$result2 = $conn->query($sql2) or die($conn->error);
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Connections </title>
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
	 <h4> Your Connections </h4>
	<?php 
		echo "<ul class='list-group'>";
		while($row1 = $result1->fetch_assoc()) {
			echo  "<li class='list-group-item'>";
			echo  "<a href='UserPage.php?id=" . $row1['UserID'] . "'>Name: " .  $row1['Firstname'] . " " . $row1['Surname'] . " " . "</a>";
			echo  "</li>";
		}
		while($row2 = $result2->fetch_assoc()) {
			echo  "<li class='list-group-item'>";
			echo  "<a href='UserPage.php?id=" . $row2['UserID'] . "'>Name: " .  $row2['Firstname'] . " " . $row2['Surname'] . " " . "</a>";
			echo  "</li>";
		}
		echo "</ul>";
		?>
	</div>
	<div class="col-6">
	  <h4> Connection Requests </h4>
	  <?php 
		echo "<ul class='list-group'>";
		while($row = $result->fetch_assoc()) {
			$_SESSION['id1'] = $row['UserID'];
			echo  "<li class='list-group-item'>";
			echo  "<a href='UserPage.php?id=" . $row['UserID'] . "'>Name: " .  $row['Firstname'] . " " . $row['Surname'] . " " . "</a>";
			echo  "<a href='AcceptConnection.php'><button type='button' class='btn btn-outline-secondary'>Accept Request</button></a>";
			echo  "<a href='DeclineConnection.php'><button type='button' class='btn btn-outline-secondary'>Decline Request</button></a>";
			echo  "</li>";
		}
		echo "</ul>";
		?>
	</div>
  </div>
</div>
</body>
</html>