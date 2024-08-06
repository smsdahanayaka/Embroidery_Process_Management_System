<?php

include '../db_connection.php';


if (isset($_POST["internalId"])) {
$output = '';
$sql = "SELECT * FROM buyerdetails WHERE InternalId  = '$internalId'";
$result = $conn->query($sql);

$output .= '
            <div class = "table-responsive">
< table class="table table-bordered">';
while($row = $result->fetch_assoc())
{
    $output.='
            <tr>
            <td width=30%><label>BuyerID</label></td>
            <td width=70%><label>'.$row["BuyerID"].'</label></td>
            </tr>
            
            
            ';
}
$output .= "</table></div>";
echo $output;
}
?>

