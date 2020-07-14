<?php
session_start();
include('includes/connect.php');
$approve_id = $_GET['approve'];
$approve_id = $conn->real_escape_string($approve_id);

 $sql = "update doctor set status=1 where id = '$approve_id'";

    // Prepare statement
    $stmt = $conn->prepare($sql);
	
if($stmt->execute())
{
	echo "<script>alert('Doctor is approved');</script>";
	echo "<script>window.open('index.php?doctor=doctor','_self')</script>";
}else{
		echo "<script>alert('Failed to approved');</script>";
	echo "<script>window.open('index.php?doctor=doctor','_self')</script>";
}
?>