<?php
include "config/connection.php";
session_start();
$user1ID = $_SESSION['id'];
$user2ID = $_SESSION['id2'];

$sql = "INSERT INTO Connections (UserID1, UserID2, CStatus) VALUES ($user1ID, $user2ID, 1)";
$conn->query($sql);

echo "<div class='alert alert-info'>";
echo 'Connection Request Sent. Redirecting you home. <meta http-equiv="refresh" content="3; url=HomePage.php">';
echo "</div>";
?>