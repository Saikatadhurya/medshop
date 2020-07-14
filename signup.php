<?php session_start();
$email = "";
require_once 'controllers/sendEmails.php';
require_once "key/lib/random.php";
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
require_once "includes/connect.php";
      $errors= array();
	  if (isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "Already logged in";
  	header('location:index.php');
  }
if (isset($_POST['reg_user'])) {
    if (empty($_POST['email'])) { array_push($errors, "Email is required"); }
    if (empty($_POST['password'])) { array_push($errors, "Password is required"); }
    if (empty($_POST['name'])) { array_push($errors, "Name is required"); }
    if (empty($_POST['mobile'])) { array_push($errors, "Phone number is required"); }

	 $name = $conn->real_escape_string($_POST['name']);
	 $mobile = $conn->real_escape_string($_POST['mobile']);
	 $email = $conn->real_escape_string($_POST['email']);
	 $password = $conn->real_escape_string($_POST['password']);
	 $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

	 
  if ($password != $confirm_password) {
	array_push($errors, "The two passwords do not match");
  }
$sql = "SELECT * FROM user WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
}
 
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database
    $stmt = $conn->prepare("INSERT INTO user (name,password,email,mobile,token) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssis", $user, $pass, $email, $mobile,$token);
      
    $user = test_input($name);
    $email = test_input($email);
    $pass = test_input($password);
    $mobile = test_input($mobile);	 
    $token = bin2hex(random_bytes(50));
    $stmt->execute();
// TO DO: send verification email to user
//sendVerificationEmail($email, $token);
$_SESSION['email'] = $email;
$_SESSION['success'] = "You are now logged in";
$_SESSION['verified'] = false;
$_SESSION['loginas'] = "patient";
echo("<script>location.href = 'index.php';</script>");	
	}else
	{
		array_push($errors, "Something went wrong");
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
            <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center text-dark font-weight-bold">Register</h5>
            <form class="form-signin" method="post" action="signup.php">
            <?php include('errors.php'); ?>
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" name="name" placeholder="Username" required autofocus>
                <label for="inputUserame">Your Name</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required>
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-label-group">
                                <input type="number"  id="mobile" class="form-control" placeholder="Mobile Number" name="mobile" required>
                                <label for="mobile">Mobile number</label>
                  </div>
              <hr>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>
              
              <div class="form-label-group">
                <input type="password" id="inputConfirmPassword" class="form-control" name="confirm_password" placeholder="Password" required>
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="reg_user">Register</button>
              <a class="d-block text-center mt-2 small" href="login.php">Log In</a>
              <hr class="my-4">
              
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