<?php
	include "../config/connection.php";
	session_start();
	
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['compID'])) {
				if(is_numeric($_REQUEST['compID'])){
					$cid  = $_REQUEST['compID'];
					$sql  = "DELETE FROM CompanyLogins WHERE CompanyID=$cid";
					$sql1 = "DELETE FROM Companies WHERE CompanyID=$cid";
					$sql2 = "DELETE FROM Vacancies WHERE CompanyID=$cid";
					$sql3 = "SELECT * FROM SkillsForVacancy JOIN Vacancies ON SkillsForVacancy.VID=Vacancies.VID WHERE Vacancies.CompanyID=$cid";
					$result = $conn->query($sql3);
					while($row = $result->fetch_assoc()) {
						$sql4 = "DELETE FROM SkillsForVacancy WHERE VID=" . $row['VID'];
						$conn->query($sql4);
					}
					
					if ($conn->query($sql2) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql) === TRUE)
					{
						echo "This Company Has Been Deleted.";
						
						header('refresh:3; url= ../HomePage.php');
					}
					else{
						echo $conn->error;
					}
					$conn->close();
					echo '<meta http-equiv="refresh" content="2; url=../CompanyPage.php?compID=' . $_SESSION['compID']'">';
					
				}
			}
		}
		else
		{
			echo "Log In As An Admin To Access This Page.";
			echo '<meta http-equiv="refresh" content="2; url=../HomePage.php">';
		}
	}
	else{
		echo "Log In As An Admin To Access This Page.";
		echo '<meta http-equiv="refresh" content="2; url=../Intro.php">';
	}
?>