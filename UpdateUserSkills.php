<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Update Academic Degrees </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/UpdateSkillsStyle.css">
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


<?php
$dsn = 'mysql:host=sql2.freesqldatabase.com;dbname=sql2227593';
$user = 'sql2227593';
$password = 'tG3*zC3*';
$UserID = $_SESSION['id'];
      
if($_POST){
    $skills = $_POST['skill'];
    $conn = new PDO($dsn, $user, $password);

    $arrLen = count($skills);
    $sidArray = array();
    $sidArrayLen = count($sidArray);
    
    for($z=0;$z<$arrLen;$z++){
        $query = "SELECT SID
                FROM Skills
                WHERE STitle = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $skills[$z]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $SID = $row['SID'];
        for ($x = 0; $x <= $sidArrayLen; $x++)
        {
            $sidArray[] = $SID;
        }
    }
    
    for($b=0;$b<$arrLen;$b++){
        $yo = $sidArray[$b];
        $sql = "INSERT INTO UserSkills
                SET
                UserID = :UserID,
                SID = :Yo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':UserID', $UserID);
        $stmt->bindParam(':Yo', $yo);
        if($stmt->execute()){
        }else{
            echo "You Can't Add A Skill You Already Have";
            return false;
        }
    }
}    
?>
<br>
<div class="container">
  <div class="row">
	<div class="col-4">
	<a href="DeleteSkills.php"><button type="button" class="btn btn-outline-secondary">Delete Skills</button></a>
	</div>
  </div>
</div>
<hr> 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

<div class="container">
  
  <div class="row">
    <div class="col-6">  
      <h2> Languages </h2>
	</div>
	<div class="col-6">
      <h2> Other Skills </h2>
	</div>
  </div>
  <div class="row">
    <div class="col-3">
    <input type="checkbox" name="skill[]" value="Java">Java<br>
    <input type="checkbox" name="skill[]" value="C">C<br>
    <input type="checkbox" name="skill[]" value="C++">C++<br>
    <input type="checkbox" name="skill[]" value="C#">C#<br>
    <input type="checkbox" name="skill[]" value="HTML">HTML<br>
    <input type="checkbox" name="skill[]" value="CSS">CSS<br>
    <input type="checkbox" name="skill[]" value="PHP">PHP<br>
    <input type="checkbox" name="skill[]" value="JavaScript">JavaScript<br>
    <input type="checkbox" name="skill[]" value="AppleScript">AppleScript<br>
    <input type="checkbox" name="skill[]" value="Python">Python<br>
    <input type="checkbox" name="skill[]" value="Lua">Lua<br>
	</div>
	<div class="col-3">
    <input type="checkbox" name="skill[]" value="SQL">SQL<br>
    <input type="checkbox" name="skill[]" value="Pascal">Pascal<br>
    <input type="checkbox" name="skill[]" value="Kotlin">Kotlin<br>
    <input type="checkbox" name="skill[]" value="XML">XML<br>
    <input type="checkbox" name="skill[]" value="XHTML">XHTML<br>
    <input type="checkbox" name="skill[]" value="Perl">Perl<br>
    <input type="checkbox" name="skill[]" value="Ruby">Ruby<br>
    <input type="checkbox" name="skill[]" value="Cobol">Cobol<br>
    <input type="checkbox" name="skill[]" value="Fortran">Fortran<br>
    <input type="checkbox" name="skill[]" value="Turing">Turing<br>
    <input type="checkbox" name="skill[]" value="Visual Basic">Visual Basic<br>
    </div>
	
	<div class="col-3">
    <input type="checkbox" name="skill[]" value="Web Design">Web Design<br>
    <input type="checkbox" name="skill[]" value="Networking">Networking<br>
    <input type="checkbox" name="skill[]" value="Android">Android<br>
    <input type="checkbox" name="skill[]" value="Apple">Apple<br>
    <input type="checkbox" name="skill[]" value="Mobile Applications">Mobile Applications<br>
    <input type="checkbox" name="skill[]" value="Software Testing">Software Testing<br>
    <input type="checkbox" name="skill[]" value="Linux">Linux<br>
    <input type="checkbox" name="skill[]" value="Cyber Security">Cyber Security<br>
    <input type="checkbox" name="skill[]" value="Data Modeling">Data Modeling<br>
    <input type="checkbox" name="skill[]" value="Animation">Animation<br>
    <input type="checkbox" name="skill[]" value="Graphic Design">Graphic Design<br>
    </div>
	<div class="col-3">
	<input type="checkbox" name="skill[]" value="Video Game Design">Video Game Design<br>
    <input type="checkbox" name="skill[]" value="Server Maintenance">Server Maintenance<br>
    <input type="checkbox" name="skill[]" value="Research Development">Research Development<br>
    <input type="checkbox" name="skill[]" value="Hardware">Hardware<br>
	<input type="checkbox" name="skill[]" value="Git">Git<br>
    <input type="checkbox" name="skill[]" value="Database Design">Database Design<br>
	<br><br><br><br>
	 <input type="submit" class="btn btn-outline-success" value="Submit"/>
	</div>
  </div>
</div>
</form>

</body>
</html>