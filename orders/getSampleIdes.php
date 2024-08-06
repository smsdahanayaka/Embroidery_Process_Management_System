<?php

include '../db_connection.php';

extract($_POST);
//
//
$BuyerID = str_replace(' ', '', $BuyerID);

$sql = "SELECT * FROM samples WHERE BuyerID = '$BuyerID' AND OrderId = 'Not yet issue'";


//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    $row = $result->fetch_assoc();
//    $SampleId = $row['SampleId'];
//    
//}

$result = $conn->query($sql);
$sampleIDS = array();

while ($row = $result->fetch_assoc()) {
    $sampleIDS[] = $row;
}
//
echo json_encode($sampleIDS);
//echo "My Product Price";


//echo json_encode($SampleId);
?>