<?php
include '../db_connection.php';



extract($_POST);

$UseStstus = "Inactive";
$sql = "UPDATE buyerdetails SET UseStstus ='$UseStstus' WHERE InternalId = '$InternalId'";
//$sql = "DELETE FROM buyerdetails WHERE InternalId = '$InternalId'";
$conn->query($sql);
 header("Location:buyers_details_admin.php");




?>

