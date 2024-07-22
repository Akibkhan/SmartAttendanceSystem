
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
	<?php if( $info['userType']== 'Admin'){ ?>
      <li class="nav-item"><a class="nav-link text-white" href="addbook.php">Add Books</a></li>
	<?php }?>
      <li class="nav-item"><a class="nav-link text-white" href="books.php">Issuse New Books</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="history.php">History</a></li>
	        <li class="nav-item"><a class="nav-link text-white" href="profile.php">Fine</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="profile.php">Profile</a></li>
</ul>

  </div>
  
  
      </div>
      <div class="bg-body-tertiary border rounded-3"><br>
       <form method="POST">
<label for="title">Name:</label>
<input type="text" name="name" class="form-control"></input><br>

<label for="email">Email:</label>
<input type="email" name="email" class="form-control"></input><br>

<label for="password">Password:</label>
<input type="password" name="password" class="form-control"></input><br>
<label for="dp">Profile Photo:</label>
<input type="file" name="dp" class="form-control"></input><br>
<label for="email">Account Type:</label>
<select class="form-control" id="userType" name="userType">
<option value="Admin">Admin</option>
<option value="User">User</option>
</select><br>
<input type="submit" class="btn btn-success"></input><br>
</form>

</div>
</div>
</div>
</body>
</html>
     <?php
	
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	    $userType = $_POST['userType'];
$sid = uniqid();
    $connection = new mysqli("localhost","root","","aur");
    $query = "INSERT INTO users(Name,Email,Password,userType,sid) VALUES('$name','$email','$password','$userType','$sid');";
    if($connection->query($query) == TRUE){
        echo "The User has been Registered!";
    }else{
        echo "Unable to Add the User!";
    }

}

?>








