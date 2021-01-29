<?php
	include "../config/connection.php";
	session_start();
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['compID'])) {
				if(is_numeric($_REQUEST['compID'])){
					$cid  = $_REQUEST['compID'];
					$sql = "UPDATE CompanyLogins SET Banned=0 WHERE CompanyID=$cid";
					if ($conn->query($sql) === TRUE) {
						echo "Ban On Company Has Been Revoked";
					}
					else{
						echo $conn->error;
					}
					$conn->close();
					echo '<meta http-equiv="refresh" content="2; url=../HomePage.php">';
					
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