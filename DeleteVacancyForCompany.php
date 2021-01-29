<?php
	include "config/connection.php";
	session_start();
	
	if(isset($_REQUEST['vid'])) {
		if(is_numeric($_REQUEST['vid'])){
			$vid = $_REQUEST['vid'];
			$cid = $_SESSION['compID'];
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
				$url = "DeleteVacancies.php";
				header('refresh:1; url=' . $url);
			}
			else{
				echo $conn->error;
			}
			$conn->close();
					
			}
		}
?>