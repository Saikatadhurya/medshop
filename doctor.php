<?php
session_start();  
include_once"includes/connect.php";
if (!isset($_SESSION['email'])) {
   $_SESSION['msg'] = "You must log in first";
   header('location: login.php');
}else if(isset($_SESSION['email']) && $_SESSION['loginas'] == "patient"){
	header('location: index.php');
}else  if(isset($_SESSION['email']) && $_SESSION['loginas'] == "clinic"){
	header('location: patientdetails.php');
}else{
   $email = $_SESSION['email'];

	$sql = "SELECT * FROM doctor where email ='$email'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$doctorid=$row['id'];
		$doctorname=$row['name'];
		$degree=$row['degree'];
		$specialization=$row['specialization'];
		$image=$row['image'];
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
        <link href="css/fontawesome/all.css" rel="stylesheet" />
		<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
		<style>
		.desktop p {
			margin:0em;
		}
		</style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
		<?php include_once("includes/header.php");?>
        <header class="masthead text-dark">
		<div class="container-fluid">
				   <div class="ml-2 p-2 bg-white" style="margin-top:-80px;">
				   <div class="row">
				   <div class="col-sm-5 col-12">
				   <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  </ol>
			  <div class="carousel-inner">
				<div class="carousel-item active">
				  <img class="d-block w-100" src="assets/img/doctor/<?php echo $image;?>" alt="First slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block w-100" src="assets/img/doctor/<?php echo $image;?>" alt="Second slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block w-100" src="assets/img/doctor/<?php echo $image;?>" alt="Third slide">
				</div>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			  </a>
			</div>
						
					</div>	
					<div class="col-sm-7 col-12">
					<h3 class="mt-0 d-none d-sm-block text-center mt-4 ml-2"><?php echo $doctorname;?></h3>
					<h5 class="mt-3 d-block d-sm-none text-center"><b><?php echo $doctorname;?></b></h5>
					<small class="text-muted"><?php echo $specialization;?>, <?php echo $degree;?></small>
		
					</div>
					</div>
					<hr>
					<?php $sql = "SELECT * FROM venue where doctorid = $doctorid";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($rows = $result->fetch_assoc()) {
                                        $shopid= $rows['shopid'];
                                       
                                        $sql1 = "SELECT * FROM clinic where id = $shopid";
                                    $result1 = $conn->query($sql1);
                                    if ($result1->num_rows > 0) {
                                       $rows1 = $result1->fetch_assoc();
                                        $shopname = $rows1['shopname'];
                                        $area = $rows1['area'];
                                        $mobile = $rows1['mobile'];
                                        $id = $rows1['id'];
                                        ?>
					 <div class="bg-white p-2 shadow rounded">
					 <div class="row">
						 <div class="col-sm-3 col-5">
							  <img class="align-self-center rounded img-fluid d-sm-block d-none" src="assets/img/shops/shop1.jpg" alt="Generic placeholder image">
							   <img class="align-self-center rounded img-fluid d-sm-none d-block mt-4" src="assets/img/shops/shop1.jpg" alt="Generic placeholder image">
						</div>  
							<div class="col-sm-6 col-7 text-left align-self-center">
								
							<h5 class="d-none d-sm-block"><?php echo $shopname;?></h5>
							<p class="d-block d-sm-none font-weight-bold" style="margin-bottom:-6px;"><?php echo $shopname;?></p>
							<small class="text-muted"><?php echo $area;?></small>
							<hr>
							<p><i class="fas fa-phone"></i> +91 <?php echo $mobile;?></p>
							</div>
							
							<div class="col-sm-3 mt-sm-5 col-12">
							
								<a href="patientlist.php?clinic=<?php echo $id;?>" type="button" class="btn d-none d-sm-block btn-block btn-outline-success">Show Patients <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
									<a href="patientlist.php?clinic=<?php echo $id;?> " type="button" class="btn d-block d-sm-none btn-sm btn-block btn-outline-success">Show Patients <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							

							</div>
						   </div>
				  
									</div><?php }
										}
									}?>
			
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
		<script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script>
        $(document).ready(function(){
            
            // Initialize select2
            $(".selUser").select2();

       
        });
    </script>
    </body>
</html>
