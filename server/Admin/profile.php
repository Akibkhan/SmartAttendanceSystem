<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="books.php" class="nav-link px-2 link-body-emphasis">Books</a></li>
          <li><a href="history.php" class="nav-link px-2 link-body-emphasis">History</a></li>
          <li><a href="fine.php" class="nav-link px-2 link-body-emphasis">Fine</a></li>
        </ul>



        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" style="">
		      <?php 
session_start();
$info = $_SESSION['userinfo'];

?>
            <li><a class="dropdown-item" href="#"><?php echo $info['Name']; ?></a></li>
            <li><a class="dropdown-item" href="profile.php">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a  class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>


<div class="container-fluid pb-2">
    <div class="d-grid gap-2" style="grid-template-columns: 1fr 4fr;">
      <div class="bg-body-tertiary border rounded-2">
  




<div class="d-flex flex-column flex-shrink-0 p-1 text-white bg-dark" style="width: 280px;">
  
    <ul class="nav nav-pills flex-column mb-auto">
	<?php  if($info['userType'] == 'Admin'){?>
      <li class="nav-item"><a class="nav-link text-white" href="addbook.php">Books</a></li>
	<?php }?>
      <li class="nav-item"><a class="nav-link text-white" href="registration.php">Add User</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="search.php">Check Record</a></li>
	 
  
</ul>

  </div>
  
  
      </div>
      <div class="bg-body-tertiary border rounded-3">
       
<h3>Your Currently Issused Books:</h3>
<table class="table table-bordered">
<thead>
<tr>
<td>S.No</td>
<td>Title</td>
<td>Author</td>
</tr></thead>
<tbody>
 
       <?php
$uid= $info['id'];
    $connection = new mysqli("localhost","root","","aur");
    $query = "SELECT * FROM BOOKS WHERE id = ANY(SELECT books_id FROM issue WHERE `contact_id` =$uid);";
    $result = $connection->query($query);
    foreach($result as $record){
        echo '<tr>';
        echo '<td>'.$record['id'].'</td>';
        echo '<td>'.$record['Title'].'</td>';
        echo '<td>'.$record['Author'].'</td>';
        echo '</tr>';
    }

?>
</tbody>

</tbody>
</table>
<h1>Attendance</h1>
<table class="table table-bordered">
<thead>
<tr>
<td>S.No</td>
<td>Course</td>
<td>Time</td>
<td>Marked</td>
</tr></thead>
<tbody>

</tbody>

<?php 
function scheduletime($sid,$cid){
  $conn = new mysqli("localhost","root","","aur");
$result = $conn->query("SELECT time FROM schedule WHERE sid='$sid' AND cid='$cid';");
foreach($result as $record){
  $time = $record['time'];
}

return $time;
}

$sid = $info['sid'];
$conn = new mysqli("localhost","root","","aur");
$result = $conn->query("SELECT * FROM courses INNER JOIN enrollment  ON courses.cid=enrollment.cid AND enrollment.sid='$sid';");
$result_attendance = $conn->query("SELECT * FROM attendance;");
$ct=0;
foreach($result as $record){
  echo '<tr><td>'.++$ct.'</td><td>'.$record['Title'].'</td><td>'.scheduletime($record['sid'],$record['cid']).'</td>';
  
  foreach($result_attendance as $rs){
    if($record['cid'] == $rs['cid'] ){
   echo '<td>'.($rs['marked']==1?"<i class='fa fa-check' style='font-size:48px;color:green;'></i>":"<i class='fa fa-close' style='font-size:48px;color:red'></i>").'</td></tr>';
  }

  }
    
  
 
}
?>



</tbody>
</table>
      </div>
    </div>
  </div>






