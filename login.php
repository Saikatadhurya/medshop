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
      if($_POST['loginas'] == "patient")
      $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
      else if($_POST['loginas'] == "doctor")
      $sql = "SELECT * FROM doctor WHERE email='$email' AND password='$password'";
      else if($_POST['loginas'] == "clinic")
      $sql = "SELECT * FROM clinic WHERE email='$email' AND password='$password'";
    
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['email'] = $email;
    $_SESSION['verified'] = $row['verified'];
      $_SESSION['message'] = "You are now logged in";
      $_SESSION['loginas'] = $_POST['loginas'];
      if($_POST['loginas'] == "patient")
      header('location: index.php');
      else if($_POST['loginas'] == "doctor")
      header('location: doctor.php');
      else if($_POST['loginas'] == "clinic")
      header('location: patientdetails.php');
}else {
    array_push($errors, "Wrong email/password combination");
}

  	
  }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MedShop</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/register.css" rel="stylesheet" />
        <link href="css/fontawesome/all.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
		<?php include_once("includes/header.php");?>
        <header class="masthead">
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
                  <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
                  <label for="inputEmail">Email address</label>
                </div>

                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                </div>
			<div class="row">	
					<div class="form-check col text-dark">
					  <input class="form-check-input" type="radio" name="loginas" id="patient" value="patient" checked>
					  <label class="form-check-label" for="patient">
						Patient
					  </label>
					</div>
						<div class="form-check col text-dark">
					  <input class="form-check-input" type="radio" name="loginas" id="doctor" value="doctor" >
					  <label class="form-check-label" for="doctor">
						Doctor
					  </label>
					</div>
					<div class="form-check col text-dark">
					  <input class="form-check-input" type="radio" name="loginas" id="clinic" value="clinic" >
					  <label class="form-check-label" for="clinic">
						Clinic
					  </label>
					</div>
				</div>
				<hr>
               
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" name="login_user">Sign in</button>
                <div class="text-center">
                  <a class="small" href="#">Forgot password?</a>
				  <div class="row">
					  <div class="col-12 col-sm-4">
						<a class="d-block text-center mt-2 small text-success" href="signup.php">Sign up as User</a>
					  </div>
					  <div class="col-12 col-sm-4">
						<a class="d-block text-center mt-2 small text-success" href="signupdoc.php">Sign up as Doctor</a>
					  </div>
					  <div class="col-12 col-sm-4">
						<a class="d-block text-center mt-2 small text-success" href="signupclinic.php">Sign up as Clinic</a>
					  </div>
				</div>
				  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        </header>
       
       <?php include_once("includes/footer.php");?>
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