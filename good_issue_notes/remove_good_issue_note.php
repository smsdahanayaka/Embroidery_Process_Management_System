<?php
include '../db_connection.php';

extract($_POST);

$RecordeStatus = "Inactive";
$sql = "UPDATE good_issue_note SET RecordeStatus ='$RecordeStatus' WHERE InternalId = '$InternalId'";
//$sql = "DELETE FROM good_issue_note WHERE InternalId = '$InternalId'";
 $conn->query($sql);
 header("Location:good_issue_note.php");
?>

