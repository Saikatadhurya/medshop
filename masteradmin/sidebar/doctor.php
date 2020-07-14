<div class="row">



              <div class="container-fluid">



                  <div class="content-panel">



                <div class="col-sm-4">



                  <input class="form-control" type="text" placeholder="Search for Doctor" id="myInput" onkeyup="myFunction()" title="Type in a name">



                <br>



                  </div>



                      <table class="table table-striped table-advance table-hover" id="myTable">



                              <br><h3><i class="fa fa-angle-right"></i>APPROVE DOCTORS HERE</h3>



                              <hr>

                              <div class="row">

<p class="col"><button class="btn btn-success btn-sm ml-2 ml-sm-0"><i class="fa fa-check-circle"></i></button> Approve</p>

<p class="col"><button class="btn btn-danger btn-sm ml-1 ml-sm-0"><i class="fas fa-trash"></i></button> Delete</p>


</div> 

                          <thead>



                          <tr>


                                  <th><i class="fa fa-question-circle"></i> Doctor's Name</th>



								  <th><i class="fa fa-question-circle"></i> Registration no.</th>


								  <th><i class="fas fa-user-circle"></i> Mobile no.</th>

								  <th><i class="far fa-sticky-note"></i> Degree</th>

								  <th><i class="fas fa-image"></i> Specialisation</th>
								  <th><i class="fas fa-image"></i> Email</th>



                                <!--  <th><i class="fa fa-bookmark"></i> Picture</th>-->



                                  <th><i class=" fa fa-edit"></i> Approve/Delete</th>



                            



                          </tr>



                          </thead>



                          <tbody>



<?php

$sql = "select * from doctor where status=0";
$result = $conn->query($sql);

      while(    $row = $result->fetch_assoc())


      {
          $id=$row['id'];
          $name=$row['name'];
          $mobile=$row['mobile'];
          $regno=$row['regno'];
          $degree=$row['degree'];
          $status=$row['status'];
          $specialization=$row['specialization'];
          $email=$row['email'];	

?>



 <tr>



    <td><?php echo $name;?></td>
    <td><?php echo $regno;?></td>
    <td><?php echo $mobile;?></td>
    <td><?php echo $degree;?></td>
    <td><?php echo $specialization;?></td>
    <td><?php echo $email;?></td>

    <td>

        <div class="row">

        <div class="col-6">

        <a href="approvedoctor.php?approve=<?php echo $id;?>"> <button class="btn btn-success btn-md"><i class="far fa-check-circle"></i></button></a>

        </div>

      <div class="col-6">							

        <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal<?php echo $id;?>"><i class="fas fa-trash"></i></button>

         </div>


      </div>
   </td>


</tr>




<div class="modal fade" id="exampleModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



<div class="modal-dialog" role="document">



<div class="modal-content">



<div class="modal-header">



<h4 class="modal-title" id="exampleModalLabel">Do You Really Want to Delete?</h4>



<button type="button" class="close" data-dismiss="modal" aria-label="Close">



<span aria-hidden="true">&times;</span>



</button>



</div>



<div class="modal-footer">
<a href="deletedoctor.php?del=<?php echo $id;?>" class="btn btn-danger">Delete</a>
<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>

</div>



</div>



</div>



</div>

<?php



      }



  ?>



</tbody>



                      </table>



                  </div><!-- /content-panel -->



              </div><!-- /col-md-12 -->



          </div><!-- /row -->



          



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