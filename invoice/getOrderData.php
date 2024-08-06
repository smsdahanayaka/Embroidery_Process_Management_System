<?php
include '../db_connection.php';

extract($_POST);

$sql = "SELECT * FROM orderdetails WHERE InternalId = '$InternalId'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$orders = $row;

echo json_encode($orders);



?>