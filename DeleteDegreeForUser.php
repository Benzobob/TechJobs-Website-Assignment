<?php
session_start();
include "config/connection.php";
if(isset($_REQUEST['adid'])){
	if(is_numeric($_REQUEST['adid'])){
		$adid = $_REQUEST['adid'];
		$uid = $_SESSION['id'];
		
		$sql = "DELETE FROM AcademicDegrees WHERE ADID = $adid";
		$sql1 = "DELETE FROM UserDegrees WHERE ADID = $adid AND UserID = $uid";
		
		if ($conn->query($sql1) === TRUE && $conn->query($sql) === TRUE){
			echo "User Degree Deleted";
			$url = "DeleteDegrees.php";
			header('refresh:1; url=' . $url);
		}
		else{
			echo $conn->error;
		}
		$conn->close();				
	}
}

?>