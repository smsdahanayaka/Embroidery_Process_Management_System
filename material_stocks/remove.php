<?php
include '../db_connection.php';

extract($_POST);

$UseStstus = "Inactive";
$sql = "UPDATE materials SET RecordeStatus ='$UseStstus' WHERE InternalId = '$InternalId'";
$conn->query($sql);
header("Location:total_stocks.php");


?>

