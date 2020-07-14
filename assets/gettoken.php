<?php
session_start();  
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } 
  $errors= array();
include_once"includes/connect.php";
if (!isset($_SESSION['email'])) {
   $_SESSION['msg'] = "You must log in first";
   header('location: login.php');
}else if(isset($_SESSION['email']) && $_SESSION['loginas'] == "doctor"){
	header('location: doctor.php');
}else  if(isset($_SESSION['email']) && $_SESSION['loginas'] == "clinic"){
	header('location: patientdetails.php');
}else{
   $email = $_SESSION['email'];
}
?>
<?php
if (isset($_POST['generate'])) {

    
    $doctorid = test_input($_POST["doctorid"]);
    $shopid = test_input($_POST["shopid"]); 
   
    $doc_type = $_FILES['file']['type'];
	  $tmp = explode('.', $_FILES['file']['name']);
      $doc_ext=strtolower(end($tmp));
      $doc_tmp = $_FILES['file']['tmp_name'];

      if( $doc_ext != "pdf"){
        echo '<script>alert("extension not allowed, please choose PDF file.")</script>' ; 
         echo("<script>location.href = 'book.php?doc=$doctorid&shop=$shopid';</script>");	
      }
     $docname =  $email.$_POST["date"].$_POST["doctorid"].$_POST["name"].".pdf";
   if( !move_uploaded_file($doc_tmp,"assets/doc/patient/".$docname))
   
    {
   
        array_push($errors, "File is not uploaded");
   
    }
   
    if (count($errors) == 0) {
   
    $stmt = $conn->prepare("INSERT INTO book (tokenno, userid, doctorid,shopid, date, doc, name, age, problem, gender, relation, phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiissssssss",$tokenno, $userid, $doctorid, $shopid, $date, $docname, $name, $age, $problem, $gender, $relation, $phone );
   
    $date = test_input($_POST["date"]);
    $slot = test_input($_POST["slot"]);
    $sql = "SELECT * FROM book where date = '$date' and doctorid=$doctorid and shopid = $shopid order by tokenno desc";
                                    $result = $conn->query($sql);
                                    if(($result->num_rows) + 1 > $slot){
                                        echo '<script>alert("Slot is full, try another date.")</script>' ;
                                        echo("<script>location.href = 'index.php';</script>");
                                        exit();
                                    }
                                    if ($result->num_rows > 0 ) {
                                       $rows = $result->fetch_assoc();
                                        $tokenno = $rows['tokenno'];
                                        $tokenno = $tokenno+1;
                                    }else{
                                        $tokenno = 1;
                                }
                                
    $name = test_input($_POST["name"]);
    $age = test_input($_POST["age"]);
    $problem = test_input($_POST["problem"]);
    $gender = test_input($_POST["gender"]);
    $relation = test_input($_POST["relation"]);
    $phone = test_input($_POST["phone"]);
    $sql1 = "SELECT * FROM user where email = '$email'";
                                    $result1 = $conn->query($sql1);
                                    if ($result1->num_rows > 0) {
                                       $rows1 = $result1->fetch_assoc();
                                        $userid = $rows1['id'];
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
        <link href="css/fontawesome/all.css" rel="stylesheet" />
		<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
		<style>
		.desktop p {
			margin:0em;
		}
        svg {
  width: 100px;
  display: block;
  margin: 40px auto 0;
}

.path {
  stroke-dasharray: 1000;
  stroke-dashoffset: 0;
  &.circle {
    -webkit-animation: dash .9s ease-in-out;
    animation: dash .9s ease-in-out;
  }
  &.line {
    stroke-dashoffset: 1000;
    -webkit-animation: dash .9s .35s ease-in-out forwards;
    animation: dash .9s .35s ease-in-out forwards;
  }
  &.check {
    stroke-dashoffset: -100;
    -webkit-animation: dash-check .9s .35s ease-in-out forwards;
    animation: dash-check .9s .35s ease-in-out forwards;
  }
}
         
p {
  text-align: center;
  margin: 20px 0 60px;
  font-size: 1.25em;
  &.success {
    color: #73AF55;
  }
  &.error {
    color: #D06079;
  }
}


@-webkit-keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@-webkit-keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

@keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

		</style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
		<?php include_once("includes/header.php");?>
        <header class="masthead text-dark">
		<div class="container-fluid">
				   <div class="ml-2 p-2 bg-white" style="margin-top:-80px;">
  <?php if($stmt->execute()){?>
				   <svg version="1.1"  viewBox="0 0 130.2 130.2">
  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
</svg>

<p class="success">Booking Confirmed!<br> "Your token number is: <b><?php echo $tokenno;?></b>""<br> Please remember the token number.</p>
<?php }else{ ?>
<svg version="1.1"  viewBox="0 0 130.2 130.2">
  <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
</svg>


<p class="error">Failed to generate token! Sorry for inconvinience</p>
					</div>
				
		</div>
<?php } 
}?>
            
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
		<script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script>
        $(document).ready(function(){
            
            // Initialize select2
            $(".selUser").select2();

       
        });
    </script>
    </body>
	
</html>
    <?php }else{
        echo("<script>location.href = 'index.php';</script>");	
    }
    ?>