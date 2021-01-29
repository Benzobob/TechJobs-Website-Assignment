<?php
	include "../config/connection.php";
	session_start();
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['compID'])) {
				if(is_numeric($_REQUEST['compID'])){
					$cid  = $_REQUEST['compID'];
					$sql = "UPDATE CompanyLogins SET Banned=1 WHERE CompanyID=$cid";
					if ($conn->query($sql) === TRUE) {
						echo "Company Has Been Banned.";
						
						if(isset($_REQUEST['compID']))
							{header('refresh:3; url= ../CompanyPage.php?compID=' . $_REQUEST['compID']);}
					}
					else{
						echo $conn->error;
					}
					$conn->close();
				}
			}
		}
		else{
			echo "Log In As An Admin To Access This Page.";
			echo '<meta http-equiv="refresh" content="2; url=../HomePage.php">';
		}
	}
	else{
		echo "Log In As An Admin To Access This Page.";
		echo '<meta http-equiv="refresh" content="2; url=../Intro.php">';
	}
?>