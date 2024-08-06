<?php
include '../db_connection.php';

extract($_POST);

$RecordeStatus = "Inactive";
$sql = "UPDATE quotations SET RecordStstus ='$RecordeStatus' WHERE InternalId = '$InternalId'";
//$sql = "DELETE FROM orderdetails WHERE InternalId = '$InternalId'";
$conn->query($sql);
 header("Location:quotations.php");
?>

