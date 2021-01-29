<?php
	include "../config/connection.php";
	session_start();
	
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['vid'])) {
				if(is_numeric($_REQUEST['vid'])){
					$vid = $_REQUEST['vid'];
					$sql  = "DELETE FROM Vacancies WHERE VID=$vid";
					$sql1 = "SELECT * FROM SkillsForVacancy JOIN Vacancies ON SkillsForVacancy.VID=Vacancies.VID WHERE Vacancies.VID=$vid";
					
					$result = $conn->query($sql1);
					while($row = $result->fetch_assoc()) {
						$sql2 = "DELETE FROM SkillsForVacancy WHERE VID=" . $row['VID'];
						$conn->query($sql2);
					}
					
					if ($conn->query($sql) === TRUE)
					{
						echo "This Vacancy Has Been Deleted.";
						header('refresh:3; url= ../HomePage.php');
					}
					else{
						echo $conn->error;
					}
					$conn->close();
					
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