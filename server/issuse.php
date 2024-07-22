<?php 
 session_start();
$info = $_SESSION['userinfo'];
echo $info['Name'];
echo "</br>";
echo $info['Email'];

?>
<form method="post">
<select name="bookid">
<?php
$bid = $_GET['id'];
$connection = new mysqli("localhost","root","","aur");
$query = "SELECT * FROM books WHERE id='$bid'";
$result = $connection->query($query);
foreach($result as $record){
    echo "<option value='".$record['id']."'>".$record['Title']."</option>";
 
}
function alreadyexist($uid,$bid){
	$connection = new mysqli("localhost","root","","aur");
	$query = "SELECT * FROM `issue` WHERE books_id='$bid' AND contact_id='$uid';";
$result = $connection->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        return True;
    } else {
        return False;
    }
} else {
    echo 'Error: ' . mysqli_error();
}

}
?>


</select><br>
    <label for="Days">Period</label>
<input type="number" name="Days"></input><br>
<input type="submit"></input>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Days = $_POST['Days'];
    $Date = date("Ymd");
    $bid = $_POST['bookid'];
    $cid = $info['id'];
    $connection = new mysqli("localhost","root","","aur");
	if(alreadyexist($cid,$bid)==True){
		header("Location: books.php");
	}else{
		    $query = "INSERT INTO issue (books_id,contact_id,Days,Date) VALUES($bid,$cid,$Days,$Date)";
   if($connection->query($query) == TRUE){
   echo "The Book has been issused!";
   header("Location: books.php");
   }else{
    echo "The Book has not been issused!";

   }
	}
}


?>