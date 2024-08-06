<?php

include '../db_connection.php';



extract($_POST);

$RecordStatus = "Inactive";
$sql = "UPDATE transactions SET RecordeStatus = '$RecordStatus' WHERE InternalId2 = '$InternalId2'";
$conn->query($sql);
header("Location:payments.php");
?>

