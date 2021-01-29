<?php 
 session_start();
 if(isset($_SESSION['id'])){
	 if($_SESSION['id'] == 1){
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update User Info </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/NavBarStyle2.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<nav class="navbar navbar-expand-sm">
   
  <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width:255px">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
	  <?php echo "<a class='active' href='../UserPage.php?id=" . $_SESSION['id'] . "' style='width:100px;height:100px;'><i class='fa fa-user fa-2x'></i></a>"; ?>
      </li>
    </ul>
	</div>
	<ul class="navbar-nav mr-auto">
	<li class="nav-item">
	<a href="../HomePage.php"><i><image src="../images/icon.PNG" style="width:100px;height:100px;"></i></a>
	</li>
	</ul>
	
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 ml-auto" action="../SearchResult.php" method="get">
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
			<?php  echo "<a href='EditUserPD.php?id=" . $_REQUEST['id'] . "'><button type='button' class='btn btn-outline-secondary'>Personal Details</button></a>" ?>
		  </li>
		  <li>
		    <?php  echo "<a href='EditUserLogin.php?id=" . $_REQUEST['id'] . "'><button type='button' class='btn btn-outline-secondary'>Login Details</button></a>" ?>
		  </li>
		  <li>
		    <?php  echo "<a href='EditUserSkills.php?id=" . $_REQUEST['id'] . "'><button type='button' class='btn btn-outline-secondary'>Skills</button></a>" ?>
		  </li>
		  <li>
		    <?php  echo "<a href='EditUserWH.php?id=" . $_REQUEST['id'] . "'><button type='button' class='btn btn-outline-secondary'>Work History</button></a>" ?>
		  </li>
		  <li>
		    <?php  echo "<a href='EditUserAD.php?id=" . $_REQUEST['id'] . "'><button type='button' class='btn btn-outline-secondary'>Academic Degrees</button></a>" ?>
		  </li>
    </div>
  </div>
</div>
	 <?php }
 }
 else{
	 echo "Log In As An Admin To Access This Page";
}?>
</body>
</html>