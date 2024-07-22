<?php 
$conn = new mysqli("localhost","root","","aur");
$sq = "SELECT profilephoto,cid,sid FROM users JOIN courses WHERE courses.cid IN (SELECT cid FROM enrollment WHERE enrollment.sid=users.sid);";
$result = $conn->query($sq);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
print json_encode($rows);



?>