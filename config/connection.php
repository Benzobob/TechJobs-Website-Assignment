<?php
$servername = "sql2.freesqldatabase.com";
$username = "sql2227593";
$password = "tG3*zC3*";
$dbname = "sql2227593";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>