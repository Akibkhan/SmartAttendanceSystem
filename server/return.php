<?php 
session_start();
$info = $_SESSION['userinfo'];
echo $info['Name'];
echo "</br>";
echo $info['Email'];
$uid = $info['id'];
?>
<?php 
function check($id,$uid){
  $conn = new mysqli("localhost","root","","aur");
  $qur = "SELECT * FROM `issue` WHERE EXISTS(SELECT * FROM `issue` WHERE books_id=$id AND `contact_id`=$uid);";
 
if(mysqli_query($conn, $qur) == TRUE){
  return True;
}else{
  return False;
}
}


?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];
  $conn = new mysqli("localhost","root","","aur");
if(check($id,$uid)==TRUE){
  $qur1 = "SELECT * FROM `books` WHERE books.id=$id";
  $result = mysqli_query($conn, $qur1);
  foreach($result as $rs){
 
  }
  $title = $rs['Title'];
  $ds = $rs['Description'];
  $auth = $rs['Author'];
$qur2 = "INSERT INTO history(Title,Description,Author) VALUES('$title','$ds','$auth');";
$result = mysqli_query($conn, $qur2);
$qur3 = "DELETE  FROM issue WHERE books_id=$id AND contact_id=$uid";
$result = mysqli_query($conn, $qur3);
header("Location:books.php");
}
  //
}


?>