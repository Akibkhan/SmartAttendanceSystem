<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$sid = $_POST['sid'];
$cid = $_POST['cid'];
$marked = $_POST['marked'];
$conn = new mysqli("localhost","root","","aur");
$sq = "INSERT INTO attendance(sid,cid,marked) values('$sid','$cid','$marked');";
$conn->query($sq);
}


?>