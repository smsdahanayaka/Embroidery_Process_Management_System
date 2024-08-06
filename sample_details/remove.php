<?php
include '../db_connection.php';
extract($_POST);



extract($_POST);

$UseStstus = "Inactive";
$sql = "UPDATE  samples SET RecordeStatus ='$UseStstus' WHERE InternalIdS = '$InternalIdS'";
//$sql = "DELETE FROM buyerdetails WHERE InternalId = '$InternalId'";
$conn->query($sql);

 header("Location:sample_details.php");
?>

