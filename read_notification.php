<?php
include 'db_connection.php';


extract($_GET);

//    $NotificationId = $_GET['id'];
    $Status = "1";
    $sql = "UPDATE notifications SET status ='$Status' WHERE InternalId = '$id'";
    $conn->query($sql);
    header("location:dashboard_admin.php");


?>