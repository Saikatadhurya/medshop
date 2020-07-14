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
   $sql = "SELECT * FROM user where email = '$email'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                       $rows = $result->fetch_assoc();
                                        $userid = $rows['id'];
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

              <div class="container-fluid">

                  <div class="content-panel">

                <div class="col-sm-4">

                  <input class="form-control" type="text" placeholder="Search for Patient" id="myInput" onkeyup="myFunction()" title="Type in a name">

     
                  </div>
		<div style="overflow-x:auto">
                      <table class="table table-striped table-advance table-hover" id="myTable">

                              <br><h3 class="text-success"><i class="fa fa-angle-right"></i>Active Bookings</h3>

                              <hr>

                          <thead>
                        
                          <tr>

                          
                              <th class="hidden-phone"><i class="fa fa-question-circle"></i> Patient Name </th>
								<th><i class="fa fa-bullhorn"></i>Token Number</th>

                              <th><i class=" fa fa-edit"></i> Clinic</th>
                              <th><i class=" fa fa-edit"></i> Doctor</th>
                              <th><i class=" fa fa-edit"></i>Date</th>
                              <th><i class=" fa fa-edit"></i>Payment Status</th>

                            

                          </tr>

                          </thead>

                          <tbody>
                          
                          <?php
                            
                           $sql = "SELECT * FROM book where userid = $userid and date >= CURDATE() order by date desc";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($rows = $result->fetch_assoc()) {
                                        $doctorid= $rows['doctorid'];
                                        $shopid= $rows['shopid'];
                                        $date= $rows['date'];
                                        $tokenno= $rows['tokenno'];
                                        $name= $rows['name'];
                                        $paystatus= $rows['paystatus'];
                                        $sql1 = "SELECT * FROM clinic where id ='$shopid'";
                                        $result1 = $conn->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            $row1 = $result1->fetch_assoc();
                                            $shopname = $row1['shopname'];
                                        }
                                        $sql2 = "SELECT * FROM doctor where id ='$doctorid'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            $row2 = $result2->fetch_assoc();
                                            $doctorname = $row2['name'];
                                        }
                                        ?>
                           <tr>
							  <td><?php echo $name;?></td>
							  <td><?php echo $tokenno;?></td>
                             <td>  <?php echo $shopname;?></td>
                             <td>  <?php echo $doctorname;?></td>
                             <td>  <?php echo $date;?></td>
							<td>
							<?php if($paystatus == 1){?>
							<span class="text-success"><i class="fas fa-check-circle"></i></span>
							
							<?php }else if($paystatus == 0){ ?>
								<span class="text-warning"><i class="fas fa-exclamation-circle"></i></span>
                                    <?php 
                                        }else{
                                      ?>
							
							<span class="text-warning"><i class="fas fa-times-circle"></i></span>
						
							</td>
                            </tr>
										<?php }
										}
										?>
              
                          </tbody>

                      </table>
</div>
                  </div><!-- /content-panel -->

              </div><!-- /col-md-12 -->

          </div>
									<?php 
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
