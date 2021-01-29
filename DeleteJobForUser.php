<?php
session_start();
include "config/connection.php";
if(isset($_REQUEST['whid'])){
	if(is_numeric($_REQUEST['whid'])){
		$whid = $_REQUEST['whid'];
		$uid = $_SESSION['id'];
		
		$sql = "DELETE FROM WorkHistory WHERE WHID = $whid AND UserID = $uid";
		
		if ($conn->query($sql) === TRUE){
			echo "Job Has Been Deleted";
			$url = "DeleteJobs.php";
			header('refresh:1; url=' . $url);
		}
		else{
			echo $conn->error;
		}
		$conn->close();				
	}
}

?>