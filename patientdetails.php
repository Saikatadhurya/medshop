<?php
session_start();  
include_once"includes/connect.php";
if (!isset($_SESSION['email'])) {
   $_SESSION['msg'] = "You must log in first";
   header('location: login.php');
}else if(isset($_SESSION['email']) && $_SESSION['loginas'] == "patient"){
	header('location: index.php');
}else  if(isset($_SESSION['email']) && $_SESSION['loginas'] == "doctor"){
	header('location: doctor.php');
}else{
   $email = $_SESSION['email'];
   $sql = "SELECT * FROM clinic where email ='$email'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $clinicid=$row['id'];
       $shopname=$row['shopname'];
       $address=$row['address'];
       $openhours=$row['openhours'];
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
				  <img class="d-block w-100" src="assets/img/shops/<?php echo $image;?>" alt="First slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block w-100" src="assets/img/shops/<?php echo $image;?>" alt="Second slide">
				</div>
				<div class="carousel-item">
				  <img class="d-block w-100" src="assets/img/shops/<?php echo $image;?>" alt="Third slide">
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
					<h3 class="mt-0 d-none d-sm-block text-center mt-4 ml-2"><?php echo $shopname;?></h3>
					<h5 class="mt-3 d-block d-sm-none text-center"><b><?php echo $shopname;?></b></h5>
					
					<hr>
				<div class="desktop d-sm-block d-none text-left mt-2">
					<p><i class="fas fa-address-card"></i> <?php echo $address;?></p>
					<p><b>Open Hours:</b> <i class="fas fa-check-circle text-success"></i> <?php echo $openhours;?> Hrs</p>
				
					</div>
					<div class="desktop d-sm-none d-block text-left mt-2 small">
					<p><i class="fas fa-phone"></i> +91 9876543210</p>
					<p><i class="fas fa-address-card"></i> <?php echo $address;?></p>
					<p><b>Open Hours:</b> <i class="fas fa-check-circle text-success"></i> <?php echo $openhours;?> Hrs</p>
				
					</div>
					<hr>
					
					</div>
					
			</div>
					<hr>
					
					<div class="row">

              <div class="container-fluid">

                  <div class="content-panel">

                <div class="col-sm-4">

                  <input class="form-control" type="text" placeholder="Search for Doctor" id="myInput" onkeyup="myFunction()" title="Type in a name">

                  </div>
		<div style="overflow-x:auto">
                      <table class="table table-striped table-advance table-hover" id="myTable">

                              <br><h3><i class="fa fa-angle-right"></i>Doctors</h3>

                              <hr>

                          <thead>

                          <tr>

                          
                              <th class="hidden-phone"><i class="fa fa-question-circle"></i> Doctor's Name </th>
								<th><i class="fa fa-bullhorn"></i>Specialization</th>
                              <th><i class=" fa fa-edit"></i> Timing</th>
                              <th><i class=" fa fa-edit"></i> View Patient</th>

                            

                          </tr>

                          </thead>

                          <tbody>
                        
                          <?php $sql = "SELECT * FROM venue where shopid = $clinicid";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($rows = $result->fetch_assoc()) {
                                        $doctorid= $rows['doctorid'];
                                        $mon= $rows['mon'];
                                        $tue= $rows['tue'];
                                        $wed= $rows['wed'];
                                        $thurs= $rows['thurs'];
                                        $fri= $rows['fri'];
                                        $sat= $rows['sat'];
                                        $sun= $rows['sun'];
                                        $sql1 = "SELECT * FROM doctor where id = $doctorid";
                                    $result1 = $conn->query($sql1);
                                    if ($result1->num_rows > 0) {
                                       $rows1 = $result1->fetch_assoc();
                                        $doctorname = $rows1['name'];
                                        $specialization = $rows1['specialization'];
                                        ?>
                           <tr>
							  <td><?php echo $doctorname;?></td>
							  <td><?php echo $specialization;?></td>
                             <td> 
                             <?php if($mon){echo "Monday: $mon<br>";}?>
                             <?php if($tue){echo "Tuesday: $tue<br>";}?>
                             <?php if($wed){echo "Wednesday: $wed<br>";}?>
                             <?php if($thurs){echo "Thursday: $thurs<br>";}?>
                             <?php if($fri){echo "Friday: $fri<br>";}?>
                             <?php if($sat){echo "Saturday: $sat<br>";}?>
                             <?php if($sun){echo "Sunday: $sun";}?>
                             </td>
							 <td><a href="viewpatient.php?doctorid=<?php echo $doctorid;?>" target="_blank"><button class="btn btn-sm btn-primary">View Patients</button></a> </td>
							
                            </tr>

                                    <?php }
                                    }
                                      } ?>
						 
                          </tbody>

                      </table>
</div>
                  </div><!-- /content-panel -->

              </div><!-- /col-md-12 -->

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
		<script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script>
        $(document).ready(function(){
            
            // Initialize select2
            $(".selUser").select2();

       
        });
    </script>
    </body>
	<script>

function myFunction() {

var input, filter, table, tr, td, i;

input = document.getElementById("myInput");

filter = input.value.toUpperCase();

table = document.getElementById("myTable");

tr = table.getElementsByTagName("tr");

for (i = 0; i < tr.length; i++) {

td = tr[i].getElementsByTagName("td")[0];

if (td) {

  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {

    tr[i].style.display = "";

  } else {

    tr[i].style.display = "none";

  }

}       

}

}

</script>
</html>
