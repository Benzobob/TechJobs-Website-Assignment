<?php
include "config/connection.php";
session_start();
$user2ID = $_SESSION['id'];
$user1ID = $_SESSION['id1'];

$sql = "UPDATE Connections SET CStatus = 3 WHERE UserID1 = $user1ID AND UserID2 = $user2ID";
$conn->query($sql);

echo "<div class='alert alert-info'>";
echo 'Connection Request Declined. <meta http-equiv="refresh" content="3; url=AccountSettings.php">';
echo "</div>";
?>