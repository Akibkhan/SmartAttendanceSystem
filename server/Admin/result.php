
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
      <li class="nav-item"><a class="nav-link text-white" href="addbook.php">Add Books</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="books.php">Issuse New Books</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="history.php">History</a></li>
	        <li class="nav-item"><a class="nav-link text-white" href="profile.php">Fine</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="profile.php">Profile</a></li>
</ul>

  </div>
  
  
      </div>
      <div class="bg-body-tertiary border rounded-3"><br>
     <table class="table table-border" border="1">
    <tr>
        
    <th>S.NO</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php
	
$uid= $_GET['id'];
    $connection = new mysqli("localhost","root","","aur");
    $query = "SELECT * FROM users WHERE id=$uid;";
    $result = $connection->query($query);
	if($result==True){
    foreach($result as $record){
        echo '<tr>';
        echo '<td>'.$record['id'].'</td>';
        echo '<td>'.$record['Name'].'</td>';
        echo '<td>'.$record['Email'].'</td>';
        echo '<td>'.'<a href="return.php?id='.$record['id'].'">Return</a>'.'</td>';
        echo '</tr>';
    }
	}else{
		echo '<tr>';
		echo "Record Not found";
		 echo '</tr>';
	}

?>
   
</table>

</div>
</div>
</div>
</body>
</html>








	  
	  

