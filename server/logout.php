<?php 
 session_start();
$info = $_SESSION['userinfo'];
session_destroy();
header("Location:index.php");
?>