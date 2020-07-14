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
}else if(isset($_SESSION['email']) && $_SESSION['loginas'] == "patient"){
	header('location: index.php');
}else  if(isset($_SESSION['email']) && $_SESSION['loginas'] == "doctor"){
	header('location: doctor.php');
}else{
   $email = $_SESSION['email'];
   $doctorid=0;
   $doctorid = test_input($_GET['doctorid']);
   $sql = "SELECT * FROM clinic where email = '$email'";
                                     $result = $conn->query($sql);
                                     if ($result->num_rows > 0) {
                                        $rows = $result->fetch_assoc();
                                         $shopid = $rows['id'];
                                     }
   $sql = "SELECT * FROM doctor where id ='$doctorid'";
    $result = $conn->query($sql);
    if ($result->num_rows <= 0) {
        
   echo("<script>location.href = 'patientlist.php';</script>");
 }
}?>
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
				   	<form method="post" action="viewpatient.php?doctorid=<?php echo $doctorid;?>">
								<div class="col-sm-5">
									<div class="form-group">
												
													<input class="form-control" name="date" type="date" placeholder="Enter date" required>
									</div>	
							</div>
							<div class="col-sm-5">
							<div class="form-group">
								   <button type="submit" class="btn btn-block btn-primary" name="submit" >Search Patient by Date</button>
							  </div>
							  </div>
					</form>
					
          <?php if(isset($_POST['date']))
        {
          $date = $_POST['date'];
          ?>
					<div class="row">

              <div class="container-fluid">

                  <div class="content-panel">

                <div class="col-sm-4">

                  <input class="form-control" type="text" placeholder="Search for Patient" id="myInput" onkeyup="myFunction()" title="Type in a name">

     
                  </div>
		<div style="overflow-x:auto">
                      <table class="table table-striped table-advance table-hover" id="myTable">

                              <br><h3><i class="fa fa-angle-right"></i>Patient Details</h3>

                              <hr>

                          <thead>
                        
                          <tr>

                          
                              <th class="hidden-phone"><i class="fa fa-question-circle"></i> Patient Name </th>
								<th><i class="fa fa-bullhorn"></i>Token Number</th>

                              <th><i class=" fa fa-edit"></i> Age</th>
                              <th><i class=" fa fa-edit"></i> Gender</th>
							  <th><i class=" fa fa-edit"></i> Phone no.</th>
                              <th><i class=" fa fa-edit"></i> Previous Prescription</th>
                              <th><i class=" fa fa-edit"></i> Problem</th>

                            

                          </tr>

                          </thead>

                          <tbody>
                          
                          <?php
                           $sql = "SELECT * FROM book where doctorid = $doctorid and shopid=$shopid and date='$date' and paystatus=1";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($rows = $result->fetch_assoc()) {
                                        $userid= $rows['userid'];
                                        $id= $rows['id'];
                                        $tokenno= $rows['tokenno'];
                                        $age= $rows['age'];
                                        $gender= $rows['gender'];
                                        $doc= $rows['doc'];
                                        $problem= $rows['problem'];
                                    
                                        $name = $rows['name'];
                                      $phone= $rows['phone'];
                                        ?>
                           <tr>
							  <td><?php echo $name;?></td>
							  <td><?php echo $tokenno;?></td>
                             <td>  <?php echo $age;?></td>
                             <td>  <?php echo $gender;?></td>
							  <td>  <?php echo $phone;?></td>
							 <?php if($doc == "No doc"){?>
							 <td>No doc</td>
							 <?php }else{ ?>
							 <td><a href="assets/doc/patient/<?php echo $doc;?>" target="_blank"><i class="fas fa-file-pdf fa-2x text-danger"></i></a> </td>
							 <?php } ?>
							 <td>
							 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php echo $id;?>">
  View Problem
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle<?php echo $id;?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle<?php echo $id;?>">Patient's Problem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php echo $problem;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</td>
                            </tr>
                                    <?php 
                                        }
                                      }else{?>
                                      <div class="alert alert-danger">No patient found</div>
<?php }?>
              
                          </tbody>

                      </table>
</div>
                  </div><!-- /content-panel -->

              </div><!-- /col-md-12 -->

          </div>
									<?php }?>
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
