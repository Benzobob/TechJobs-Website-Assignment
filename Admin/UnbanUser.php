<?php
	include "../config/connection.php";
	session_start();
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['id'])) {
				if(is_numeric($_REQUEST['id'])){
					$uid  = $_REQUEST['id'];
					$sql = "UPDATE UserLogins SET Banned=0 WHERE UserID=$uid";
					if ($conn->query($sql) === TRUE) {
						echo "Ban On User Has Been Revoked";
					}
					else{
						echo $conn->error;
					}
					echo '<meta http-equiv="refresh" content="2; url=../HomePage.php">';
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