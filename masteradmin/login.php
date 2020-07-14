<?php
session_start();
$errors = array();
$email = "";
require_once "includes/connect.php";
if (isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "Already logged in";
  	header('location: index.php');
  }
  else{}
if (isset($_POST['login_user'])){
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['password']);;

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
      $password = md5($password);
     
      $sql = "SELECT * FROM masteradmin WHERE email='$email' AND password='$password'";
       
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['email'] = $email;
    
      header('location: index.php');
    
}else {
    array_push($errors, "Wrong email/password combination");
}

  	
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome/all.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css" integrity="sha256-rFMLRbqAytD9ic/37Rnzr2Ycy/RlpxE5QH52h7VoIZo=" crossorigin="anonymous" />

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  <link href="css/menu.css" rel="stylesheet">

<!-- CSS -->
<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
</head>

<body>

  <!-- Navigation -->
  <?php include_once"includes/navbar.php";?>
            <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center text-dark font-weight-bold">Welcome back!</h5>
             <div class="col-md-9 col-lg-8 mx-auto">
              <form method="post" action="login.php">
              <?php include('errors.php'); ?>
                <div class="form-label-group">
                  <input type="text" id="inputEmail" class="form-control" name="email" placeholder="username" required autofocus>
                </div>

                <div class="form-label-group mt-4">
                  <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                </div>
				<hr>
               
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="login_user">Sign in</button>
               
				  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
   

	    <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>