<?php
include('includes/connect.php');

$delete_id = $_GET['del'];
$delete_id = $conn->real_escape_string($delete_id);
$sql = "select * from doctor where id = '$delete_id'";
$result = $conn->query($sql);
 $row = $result->fetch_assoc();
$image = $row['image'];
unlink("../assets/img/doctor/$image");

$delete_query = "delete from doctor where id = '$delete_id'";
 $stmt = $conn->prepare($delete_query);
	
if($stmt->execute())
{
	echo "<script>alert('Post Has Been Deleted..');</script>";
	echo "<script>window.open('index.php?doctor=doctor','_self')</script>";
}else{
	echo "<script>alert('Post Deletion FAILED');</script>";
	echo "<script>window.open('index.php?docotr=doctor','_self')</script>";
}
?>