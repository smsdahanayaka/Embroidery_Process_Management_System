<?php

include '../db_connection.php';

extract($_POST);


$sql = "SELECT * FROM orderdetails WHERE BuyerID  = '$BuyerID'";
$result = $conn->query($sql);
$orders = array();
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);

?>