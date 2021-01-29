<?php
session_start();
include "../config/connection.php";
if(isset($_REQUEST['sid'])){
	if(is_numeric($_REQUEST['sid'])){
		$sid = $_REQUEST['sid'];
		$uid = $_SESSION['idToUser'];
		
		$sql = "DELETE FROM UserSkills WHERE SID = $sid AND UserID = $uid";
		
		if ($conn->query($sql) === TRUE){
			echo "Skill Has Been Deleted";
			$url = "EditUserSkills.php?id=" . $uid;
			header('refresh:1; url=' . $url);
		}
		else{
			echo $conn->error;
		}
		$conn->close();				
	}
}

?>