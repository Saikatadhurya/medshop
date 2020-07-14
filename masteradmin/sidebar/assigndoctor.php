<?php    
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
	
	if ($_POST["doctorid"] == "") {
        array_push($errors, "Select a doctor");
    }
    if ($_POST["shopid"] == "") {
        array_push($errors, "Select a clinic");
  }
  if (!isset($_POST["slot"])) {
    array_push($errors, "Enter slots");
}
	
   



    if (count($errors) == 0) {
        $stmt = $conn->prepare("INSERT INTO venue (doctorid,shopid,slot,charge, mon,tue,wed,thurs,fri,sat,sun) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiissssssss", $doctorid, $shopid, $slot, $charge, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday);
        $doctorid = test_input($_POST["doctorid"]);
        $shopid = test_input($_POST["shopid"]);
        $slot = test_input($_POST["slot"]);
        $charge = test_input($_POST["charge"]);
        if(isset($_POST["wednesday"]))
        $wednesday = test_input($_POST["wednesday"]);
        else
        $wednesday="";

        if(isset($_POST["thursday"]))
        $thursday = test_input($_POST["thursday"]);
        else
        $thursday="";

        if(isset($_POST["friday"]))
        $friday = test_input($_POST["friday"]);
        else
        $friday="";

        if(isset($_POST["monday"]))
        $monday = test_input($_POST["monday"]);
        else
        $monday="";

        if(isset($_POST["tuesday"]))
        $tuesday = test_input($_POST["tuesday"]);
        else
        $tuesday="";

        if(isset($_POST["saturday"]))
        $saturday = test_input($_POST["saturday"]);
        else
        $saturday="";

        if(isset($_POST["sunday"]))
        $sunday = test_input($_POST["sunday"]);
        else
        $sunday="";
    
        if($stmt->execute())
        $_SESSION['success']="Successfully Added";
        else
        array_push($errors, "Failed to set");

    }
    
}

?>
<form action="./index.php?assigndoctor=assigndoctor " method="POST">

<div class="container">
<?php include('errors.php'); ?>
<?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </div>
 <?php endif;?>
<div class="row">
		
			<div class="col-sm-12">
			<div class="form-group">
			<label>Select Doctor</label>
								<select class="form-control selUser" id="doctorid" name="doctorid" required >
								  <option value="">Select Doctor</option>
								<?php
                                    $sql = "SELECT * FROM doctor";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?> : <?php echo $row['regno'];?>(<?php echo $row['specialization'];?>)</option>
                                    <?php 
                                        }
                                    }
                                    ?>
								</select>
                            </div>
				</div>
                <div class="col-sm-4">
			<div class="form-group">
			<label>Select Clinic</label>
								<select class="form-control selUser" id="shopid" name="shopid" required >
								  <option value="">Select Clinic</option>
								<?php
                                    $sql = "SELECT * FROM clinic WHERE city = '$city'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['shopname'];?>(<?php echo $row['area'];?>)</option>
                                    <?php 
                                        }
                                    }
                                    ?>
								</select>
                            </div>
				</div>
		 <div class="col-sm-2">
        <div class="form-label-group">
        <label for="slot">Slots</label>
                                <input type="number"  id="slot" class="form-control" placeholder="Enter number of Slots" name="slot" required>
                               
                  </div>
				  </div>
		 <div class="col-sm-2">
        <div class="form-label-group">
        <label for="slot">Charge per patient</label>
                                <input type="text"  id="slot" class="form-control" placeholder="Enter charge in Rs." name="charge" required>
                               
                  </div>
				  </div>
              <div class="col-sm-4">
              <div class="row">
              <div class="col-12">
                <input type="checkbox" onclick="dynInput(this);" id="monday" />
                <label class="form-check-label" for="monday">Monday</label>
                </div>
                <div class="col-12">
                <input type="checkbox"  onclick="dynInput(this);" id="tuesday" />
                <label class="form-check-label" for="tuesday">Tuesday</label>
                  </div>
                  <div class="col-12">                  
                <input type="checkbox"  onclick="dynInput(this);" id="wednesday" />
                <label class="form-check-label" for="wednesday">Wednesday</label>
                </div>
                <div class="col-12">
                <input type="checkbox"  onclick="dynInput(this);" id="thursday" />
                <label class="form-check-label" for="thursday">Thursday</label>
                </div>
                <div class="col-12">
                <input type="checkbox" onclick="dynInput(this);" id="friday" />
                <label class="form-check-label" for="friday">Friday</label>
                </div>
                <div class="col-12">
                <input type="checkbox"  onclick="dynInput(this);" id="saturday" />
                <label class="form-check-label" for="saturday">Saturday</label>
                </div>
                <div class="col-12">
                <input type="checkbox" onclick="dynInput(this);" id="sunday" />
                <label class="form-check-label" for="sunday">Sunday</label>
                </div>
              </div>

                <p id="insertinputs"></p>
            </div>              
            <div class="col-sm-12">		 
                <div class="form-group">
                     <button type="submit" class="btn btn-primary" name="submit">Assign Doctor</button>
                </div>
            </div>
</div>
</form>
