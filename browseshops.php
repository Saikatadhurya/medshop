<?php
session_start(); 
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } 
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
   $specialization = test_input($_GET['catagory']);
   $area = test_input($_GET['area']);
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
    </head>
    <body id="page-top">
        <!-- Navigation-->
		<?php include_once("includes/header.php");?>
        <header class="masthead">
            <div class="container text-dark bg-light p-4" style="margin-top:-80px;">
            <?php $sql = "SELECT distinct c.id as clinicid, c.shopname as clinicname, c.mobile as mobile, c.address as address, c.area as area FROM clinic c, doctor d where (c.id, d.id) IN (select shopid, doctorid FROM venue) and area='$area' and specialization='$specialization'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($rows = $result->fetch_assoc()) {
                                        $clinicname= $rows['clinicname'];
                                        $mobile= $rows['mobile'];
                                        $address= $rows['address'];
                                        $area= $rows['area'];
                                        $clinicid= $rows['clinicid'];
                                       
                                        ?>
             <div class="bg-white p-2 shadow rounded">
					 <div class="row">
						 <div class="col-sm-3 col-5">
							  <img class="align-self-center rounded img-fluid d-sm-block d-none" src="assets/img/shops/shop1.jpg" alt="Generic placeholder image">
							   <img class="align-self-center rounded img-fluid d-sm-none d-block mt-4" src="assets/img/shops/shop1.jpg" alt="Generic placeholder image">
						</div>  
							<div class="col-sm-6 col-7 text-left align-self-center">
								
							<h5 class="d-none d-sm-block"><?php echo $clinicname;?></h5>
							<p class="d-block d-sm-none font-weight-bold" style="margin-bottom:-6px;"><?php echo $clinicname;?></p>
							<small class="text-muted"><?php echo $area;?></small>
							<hr>
							<p><i class="fas fa-phone"></i> +91 <?php echo $mobile;?></p>
							</div>
							
							<div class="col-sm-3 mt-sm-5 col-12">
							
								<a href="shop.php?clinicid=<?php echo $clinicid;?>&spec=<?php echo $specialization;?>" type="button" class="btn d-none d-sm-block btn-block btn-outline-success">BOOK NOW <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									<a href="shop.php?clinicid=<?php echo $clinicid;?>&spec=<?php echo $specialization;?>" type="button" class="btn d-block d-sm-none btn-sm btn-block btn-outline-success">BOOK NOW <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							

							</div>
						   </div>
				  
			</div>
                                    <?php }
                                        }else {
                                    
                                ?>
			 <div class="alert alert-danger"> No Clinic found with this catagory in this area, to search <a href="index.php#findshop" class="font-weight-bold text-info">click here</a></div> 
                                        <?php } ?>
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
		<script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script>
        $(document).ready(function(){
            
            // Initialize select2
            $(".selUser").select2();

       
        });
    </script>
    </body>
</html>
