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
	
$imagename = "";    
	$target_dir = "assets/img/shops/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (empty($_POST['email'])) { array_push($errors, "Email is required"); }
    if (empty($_POST['password'])) { array_push($errors, "Password is required"); }
    if (empty($_POST['name'])) { array_push($errors, "Name is required"); }
    if (empty($_POST['mobile'])) { array_push($errors, "Phone number is required"); }
    if (empty($_POST['address'])) { array_push($errors, "Address is required"); }
	if (empty($_POST["openhours"])) {
        array_push($errors, "Open hours is required");
	}
	if ($_POST["area"] == "") {
        array_push($errors, "Area is required");
	}
	
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        array_push($errors, "File is not an image");
        $uploadOk = 0;
    }
		// Check if file already exists
	if (file_exists($target_file)) {
		array_push($errors, "Sorry, file already exists");
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["image"]["size"] > 5000000) {
		array_push($errors, "Sorry, your file is too large");
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed");
		$uploadOk = 0;
	}
	
	 $name = $conn->real_escape_string($_POST['name']);
	 $mobile = $conn->real_escape_string($_POST['mobile']);
	 $email = $conn->real_escape_string($_POST['email']);
	 $password = $conn->real_escape_string($_POST['password']);
	 $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

	 
  if ($password != $confirm_password) {
	array_push($errors, "The two passwords do not match");
  }
$sql = "SELECT * FROM clinic WHERE email='$email' LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
      }
}
 
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database
     $stmt = $conn->prepare("INSERT INTO clinic (shopname,password,email,mobile,token, address,openhours,area,city,image, regno) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssssss", $user, $pass, $email,$mobile,$token, $address, $openhours, $area, $city, $imagename, $regno);
      
    $user = test_input($name);
    $email = test_input($email);
    $pass = test_input($password);
    $mobile = test_input($mobile);	 
    $token = bin2hex(random_bytes(50));
	$address = test_input($_POST["address"]);
    $openhours = test_input($_POST["openhours"]);
	$regno = test_input($_POST["regno"]);
	$area = test_input($_POST["area"]);
	$city = test_input($_POST["city"]);
	$imagename= $_FILES["image"]["name"];
    $imagename = test_input($imagename);

// TO DO: send verification email to user
//sendVerificationEmail($email, $token);
        // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    array_push($errors, "Sorry, your file was not uploaded");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $_SESSION['success']="Successfully Added";
		$stmt->execute();
    } else {
        array_push($errors, "Sorry, there was an error uploading your file.");
    }
}

$_SESSION['email'] = $email;
$_SESSION['success'] = "You are now logged in";
$_SESSION['verified'] = false;
$_SESSION['loginas'] = "clinic";
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
            <form class="form-signin was-validated" method="post" action="signupclinic.php" enctype="multipart/form-data">
            <?php include('errors.php'); ?>
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" name="name" placeholder="Username" required autofocus>
                <label for="inputUserame">Enter Clinic Name</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required>
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-label-group">
                                <input type="number"  id="mobile" class="form-control" placeholder="Mobile Number" name="mobile" required>
                                <label for="mobile">Mobile number</label>
               </div>
			   <div class="form-label-group">
                <input type="text" id="inputregno" class="form-control" name="regno" placeholder="rego" required>
                <label for="inputregno">Registration Number</label>
              </div>
			    <div class="form-label-group">
								
								
								<select class="form-control selUser" name="area" id="area" required>
									<option value="">Choose Area</option>
									<?php
										$sql = "SELECT * FROM area";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
										?>
											<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
										<?php 
											}
										}
										?>
								</select>
              </div>
			  <div class="form-label-group">
								
								
								<select class="form-control selUser" name="city" id="city" required>
									<option value="">Choose City</option>
									<?php
										$sql = "SELECT * FROM city";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
											while($row = $result->fetch_assoc()) {
										?>
											<option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
										<?php 
											}
										}
										?>
								</select>
              </div>
			  <div class="form-label-group">
                <input type="text" id="inputadress" class="form-control" name="address" placeholder="address" required>
                <label for="inputadress">Enter Address</label>
              </div>
			  <div class="form-label-group">
                <input type="text" id="inputopenhours" class="form-control" name="openhours" placeholder="openhours" required>
                <label for="inputopenhours">Enter Opening Hour</label>
              </div>
			<div class="form-group">
							<div class="custom-file form-control">
							  <input type="file" class="custom-file-input" name="image"  id="customFile" required>
							  <label class="custom-file-label text-left" for="customFile"><small>Your Image</small></label>
							</div>	
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