<?php
	include "../config/connection.php";
	session_start();
	
	if(isset($_SESSION['id'])){
		if($_SESSION['id'] == 1){
			if(isset($_REQUEST['id'])) {
				if(is_numeric($_REQUEST['id'])){
					$uid  = $_REQUEST['id'];
					$sql  = "DELETE FROM UserLogins WHERE UserID=$uid";
					$sql1 = "DELETE FROM Users WHERE UserID=$uid";
					$sql2 = "DELETE FROM UserProjects WHERE UserID=$uid";
					$sql3 = "DELETE FROM UserDegrees WHERE UserID=$uid";
					$sql4 = "DELETE FROM WorkHistory WHERE UserID=$uid";
					$sql5 = "DELETE FROM Connections WHERE UserID1=$uid OR UserID2=$uid";
					
					if ($conn->query($sql5) === TRUE && $conn->query($sql4) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql2) === TRUE	&& $conn->query($sql1) === TRUE	&& $conn->query($sql) === TRUE)
					{
						echo "This User Has Been Deleted.";
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
