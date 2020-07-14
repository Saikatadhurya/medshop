<?php 
session_start();  
include_once"includes/connect.php";
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}else{
   $email = $_SESSION['email'];
}
$sql = "SELECT * FROM masteradmin where email = '$email'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$city = $row['city'];
										
										}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/fontawesome/all.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css" integrity="sha256-rFMLRbqAytD9ic/37Rnzr2Ycy/RlpxE5QH52h7VoIZo=" crossorigin="anonymous" />

  <!-- Custom styles for this template -->
  <link href="css/shop-homepage.css" rel="stylesheet">
  <link href="css/menu.css" rel="stylesheet">

<!-- CSS -->
<link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
</head>

<body>

  <!-- Navigation -->
  <?php include_once"includes/navbar.php";?>
  

<div class="container">

<?php include_once"includes/connect.php";
$errors = array();
if(!isset($_GET['clinic']) OR !isset($_GET['doctor']) OR !isset($_GET['assigndoctor'])){
	?>
	
<center>	<h3>Welcome to Admin Panel</h3>	</center>
	
	<?php 
}
	
	
				if(isset($_GET['clinic']))

				{

				include('sidebar/clinic.php');	

                }

                if(isset($_GET['doctor']))

				{

				include('sidebar/doctor.php');	

                }
                   if(isset($_GET['assigndoctor']))

				{

				include('sidebar/assigndoctor.php');	

                }
                

	?>
</div>

  <!-- Bootstrap core JavaScript -->

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script id="rendered-js" src="js/menu.js"></script>
  <script src='../select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script>
        $(document).ready(function(){
            
            // Initialize select2
            $(".selUser").select2();

       
        });
    </script>
<script>
function dynInput(cbox) {
      if (cbox.checked) {
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", cbox.id);
        input.setAttribute("class", "form-control");
        input.setAttribute("placeholder", "e.g (9am to 11am)");
        var div = document.createElement("div");
        div.setAttribute("id", cbox.id+"div");
        div.innerHTML = "Time for "+cbox.id+" ";
        div.appendChild(input);
        document.getElementById("insertinputs").appendChild(div);
      } else {
        document.getElementById(cbox.id+"div").remove();
      }
    }
    </script>
</body>

</html>
