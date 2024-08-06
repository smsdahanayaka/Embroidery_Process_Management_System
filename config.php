<?php
//variable for site url
define("site_url", "http://localhost/Embroidery_Process_Management_System/");
define("site_url2", "http://localhost/Embroidery_Process_Management_System/read_notification.php");
define("site_url3", "http://localhost/Embroidery_Process_Management_System/dashboard.php");


//function for Data clean
function dataClean($data = null) {
    $val = trim(stripslashes((htmlspecialchars($data))));
    return $val;
}

function idGenerator( $prefix=null, $table=null, $col=nlll, $ordercol=null) {
    
    include '../db_connection.php';
    
    $sql = "SELECT $col FROM $table ORDER BY $ordercol DESC LIMIT 1";
    
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
    $lastID = @$row[$col];

    if (empty($lastID)) {
        $generatedId = $prefix."000001";
    } else {
        $idd = str_replace($prefix, "", $lastID);
        $id = str_pad($idd + 1, 6, 0, STR_PAD_LEFT);
        $generatedId = $prefix . $id;
    }
    
return $generatedId;

}




?>