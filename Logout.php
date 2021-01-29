<?php 
session_start();
if(isset($_SESSION['id'])){
session_unset($_SESSION['id']);}
if(isset($_SESSION['compID'])){
session_unset($_SESSION['compID']);}
session_destroy();

header("location:Intro.php");
exit();
?>