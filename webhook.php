<?php
include_once"includes/connect.php";

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data),"623f933c9ea541ee8cddbdb652c18e60");
if($mac_provided == $mac_calculated){
    if($data['status'] == "Credit"){
         $purpose = $data['purpose'];
       // Payment was successful, mark it as completed in your database  
       $sql = "UPDATE book SET paystatus=1 WHERE purpose='$purpose'";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->execute(); 
    }
    else{
           $purpose = $data['purpose'];
       $sql = "UPDATE book SET paystatus=2 WHERE purpose='$purpose'";
	    $stmt = $conn->prepare($sql);
		 $stmt->execute(); 
    }
}
else{
    echo "MAC mismatch";
}

?>
