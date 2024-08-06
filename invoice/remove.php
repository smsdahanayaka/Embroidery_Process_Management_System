<?php

include '../db_connection.php';

extract($_POST);

$sql8 = "SELECT * FROM payment_details WHERE BuyerID = '$BuyerID'";
$result8 = $conn->query($sql8);
$row = $result8->fetch_assoc();
@$Invoice_total = $row['Invoice_total'];


$RecordeStatus = "Inactive";
$sql = "UPDATE invoice SET RecordStatus ='$RecordeStatus' WHERE invoiceId = '$invoiceId'";
//$sql = "DELETE FROM orderdetails WHERE InternalId = '$InternalId'";
$conn->query($sql);

$Invoice_total = $Invoice_total - $TotalAmount;
$sql9 = "UPDATE payment_details SET Invoice_total ='$Invoice_total' WHERE BuyerID = '$BuyerID'";
$conn->query($sql9);

header("Location:invoice.php");
?>

