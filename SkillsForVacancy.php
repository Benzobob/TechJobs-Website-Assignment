<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> Skills For Vacancy </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/NavBarStyle2.css">
  <link rel="stylesheet" href="css/UpdateSkillsStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


<?php
// include classes
include_once 'config/database.php';
      
if($_POST){
//    $dsn = 'mysql:host=sql2.freesqldatabase.com;dbname=sql2227593';
//    $user = 'sql2227593';
//    $password = 'tG3*zC3*';
//    $conn = new PDO($dsn, $user, $password);
    $database = new Database();
    $conn = $database->getConnection();
    
    $skills = $_POST['skill'];

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
        $sql = "INSERT INTO SkillsForVacancy
                SET
                VID = :VID,
                SID = :Yo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':VID', $_SESSION['VacID']);
        $stmt->bindParam(':Yo', $yo);
        if($stmt->execute()){
            //echo '<meta http-equiv="refresh" content="2; url=CompanyPage.php?compID=' . $_SESSION['compID'] . '">';
        }else{
            echo "error";
            return false;
        }
    }
}    
//}
      
?>
      
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