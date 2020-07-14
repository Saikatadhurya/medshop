<?php
session_start();
include('includes/connect.php');
$approve_id = $_GET['approve'];
$approve_id = $conn->real_escape_string($approve_id);

 $sql = "update clinic set status=1 where id = '$approve_id'";

    // Prepare statement
    $stmt = $conn->prepare($sql);
	
if($stmt->execute())
{
	echo "<script>alert('Clinic is approved');</script>";
	echo "<script>window.open('index.php?clinic=clinic','_self')</script>";
}else{
		echo "<script>alert('Failed to approved');</script>";
	echo "<script>window.open('index.php?clinic=clinic','_self')</script>";
}
?>