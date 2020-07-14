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
   $shopid = test_input($_GET['shop']);
   $doctorid = test_input($_GET['doc']);
   $sql = "SELECT * FROM doctor where id = $doctorid";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
	  $rows = $result->fetch_assoc();
	   $doctorname = $rows['name'];
	   $specialization = $rows['specialization'];
	   $mobileno = $rows['mobile'];
	   $degree = $rows['degree'];
	   $image = $rows['image'];

	   $sql1 = "SELECT * FROM venue where shopid = $shopid and doctorid=$doctorid";
	   $result1 = $conn->query($sql1);
	   if ($result1->num_rows > 0) {
		   $rows1 = $result1->fetch_assoc();
		   $mon= $rows1['mon'];
		   $tue= $rows1['tue'];
		   $wed= $rows1['wed'];
		   $thurs= $rows1['thurs'];
		   $fri= $rows1['fri'];
		   $sat= $rows1['sat'];
		   $sun= $rows1['sun'];
		   $slot= $rows1['slot'];
		   $charge= $rows1['charge'];
		   
	   }
	   $sql2 = "SELECT * FROM clinic where id = $shopid";
	   $result1 = $conn->query($sql2);
	   if ($result1->num_rows > 0) {
		$rows2 = $result1->fetch_assoc();
		$shopname = $rows2['shopname'];
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
        <link href="css/fontawesome/all.css" rel="stylesheet" />
		<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
		
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
					<hr>
					<a href="tel:+917031490599" class="btn btn-primary d-sm-none d-block btn-block">Call Now <i class="fa fa-phone" aria-hidden="true"></i></a>
					<div class="desktop d-sm-block d-none text-left mt-sm-0">
					<p><i class="fas fa-phone"></i> +91 <?php echo $mobileno;?></p>
							<p><b>Timings:</b> <?php if($mon){echo "Monday: $mon<br>";}?>
                             <?php if($tue){echo "Tuesday: $tue<br>";}?>
                             <?php if($wed){echo "Wednesday: $wed<br>";}?>
                             <?php if($thurs){echo "Thursday: $thurs<br>";}?>
                             <?php if($fri){echo "Friday: $fri<br>";}?>
                             <?php if($sat){echo "Saturday: $sat<br>";}?>
                             <?php if($sun){echo "Sunday: $sun";}?></p>
						<p><b>Clinic:</b> <?php echo $shopname;?></p>
					    <p><b>Fee:</b> Rs. <?php echo $charge;?> per patient</p>
			
					</div>
					<div class="desktop d-sm-none d-block text-left mt-2 small">
					<p><i class="fas fa-phone"></i> +91 <?php echo $mobileno;?></p>
							<p class="small"><b>Timings:</b> <?php if($mon){echo "Monday: $mon<br>";}?>
                             <?php if($tue){echo "Tuesday: $tue<br>";}?>
                             <?php if($wed){echo "Wednesday: $wed<br>";}?>
                             <?php if($thurs){echo "Thursday: $thurs<br>";}?>
                             <?php if($fri){echo "Friday: $fri<br>";}?>
                             <?php if($sat){echo "Saturday: $sat<br>";}?>
                             <?php if($sun){echo "Sunday: $sun";}?></p>
							 	<p class="small"><b>Clinic:</b> <?php echo $shopname;?></p>
							 	<p class="small"><b>Charge per Patient:</b> <?php echo $charge;?></p>
					
					</div>
					</div>
					</div>
					<hr>
					
					
					   <form method="POST" enctype="multipart/form-data" action="payment.php"  class="was-validated">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Patient's Name *" required />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="age" id="age" type="number" placeholder="Patient's Age *" required />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" name="phone" id="phone" type="tel" placeholder="Patient's Phone *" required />
                                <p class="help-block text-danger"></p>
                            </div>
							<div class="form-group">
								<select class="form-control" name="relation" id="relation" required >
								  <option value="">Relation with Patient</option>
								  <option value="Self">Self</option>
								  <option value="Mother">Mother</option>
								  <option value="Father">Father</option>
								  <option value="child">Child</option>
								  <option value="relative">Relative</option>
								  <option value="Others">Others</option>
								  
								</select>
                            </div>
							<div class="form-group">
								<select class="form-control" name="gender" id="gender" required >
								  <option value="">Patient's Gender</option>
								  <option value="male">Male</option>
								  <option value="female">Female</option>
								</select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
							<div class="form-group">
								<select class="form-control" id="date" name="date" required >
								  <option value="">Select day for booking</option>
								  <?php if($mon){ $stamp =  strtotime('next Monday'); $stamp = date("Y-m-d", $stamp);?> <option value="<?php echo $stamp;?>"><?php echo "Monday: $mon";?></option><?php } ?>
                             <?php if($tue){$stamp =  strtotime('next Tuesday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Tuesday: $tue";?></option><?php } ?>
                             <?php if($wed){$stamp =  strtotime('next Wednesday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Wednesday: $wed";?></option><?php } ?>
                             <?php if($thurs){$stamp =  strtotime('next Thursday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Thursday: $thurs";?></option><?php } ?>
                             <?php if($fri){$stamp =  strtotime('next Friday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Friday: $fri";?></option><?php } ?>
                             <?php if($sat){$stamp =  strtotime('next Saturday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Saturday: $sat";?></option><?php } ?>
                             <?php if($sun){$stamp =  strtotime('next Sunday');  $stamp = date("Y-m-d", $stamp);?>  <option value="<?php echo $stamp;?>"><?php echo "Sunday: $sun";?></option><?php } ?></p>
								</select>
                            </div>
							<div class="form-group">
							<div class="custom-file form-control">
							  <input type="file" class="custom-file-input" name="file" accept="application/pdf" id="customFile">
							  <label class="custom-file-label text-left" for="customFile"><small>Prescription and reports (in pdf)</small></label>
							</div>	
							</div>	
							 <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" name="problem" id="message" placeholder="Your Problem in brief*" rows="5" required></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
							
                        </div>
                    </div>
					<input type="text" value="<?php echo $doctorid;?>" style="display:none" name="doctorid"/>
					<input type="text" value="<?php echo $shopid;?>" style="display:none" name="shopid"/>
					<input type="text" value="<?php echo $slot;?>" style="display:none" name="slot"/>
					<input type="text" value="<?php echo $doctorname;?>" style="display:none" name="doctorname"/>
					<input type="text" value="<?php echo $shopname;?>" style="display:none" name="shopname"/>
					<input type="text" value="100" style="display:none" name="price"/>
                    <div class="text-center">
                        <button class="btn btn-primary btn-xl text-uppercase" name="generate" type="submit">Pay Rs.100 and Get Token</button>
                    </div>
					
                </form>
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
