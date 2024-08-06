<?php
ob_start();
include '../header.php';
include '../db_connection.php';
?>  
<?php
extract($_POST);
$error = array();
if ($_SERVER['REQUEST_METHOD'] == "POST" && @$operate == "update") {
    if (empty($error)) {
        $sql = "UPDATE good_issue_note SET Date='$Date',VehicleNo='$VehicleNo',DeliveryTo='$DeliveryTo',Discription='$Discription',Remarks='$Remarks' WHERE InternalId = '$InternalId'";
        $conn->query($sql);
        header("Location:good_issue_note.php");
    }
}
$sql = "SELECT * FROM good_issue_note WHERE InternalId ='$InternalId'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $InternalId = $row['InternalId'];
    $GIR_Number = $row['GIR_Number'];
    $Date = $row['Date'];
    $VehicleNo = $row['VehicleNo'];
    $OrderId = $row['OrderId'];
    $DeliveryTo = $row['DeliveryTo'];
    $Discription = $row['Discription'];
    $Remarks = $row['Remarks'];
    $Status = $row['Status'];
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-2 border-bottom">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Good Issue Note | Update </h3>
    <div>
        <a href="<?php echo site_url; ?>good_issue_notes/good_issue_note.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        Update Good Issue Note
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="GIR_Number" class="form-label">GIR Number</label>
                            <input type="text" class="form-control" id="GIR_Number" name="GIR_Number" value="<?php echo @$GIR_Number; ?>" readonly >
                            <span class="text-danger"><?php echo @$error['GIR_Number']; ?> </span>
                        </div>   
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Date" class="form-label">Date</label>
                            <input type="Date" class="form-control" id="Date" name="Date" value="<?php echo@$Date; ?>">
                            <span class="text-danger"><?php echo @$error['Date']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="OrderId" class="form-label">Order Id</label>
                            <input type="text" class="form-control" id="OrderId" name="OrderId" value="<?php echo @$OrderId; ?>" readonly >
                            <span class="text-danger"><?php echo @$error['OrderId']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="VehicleNo" class="form-label">Vehicle No.</label>
                            <input type="text" class="form-control" id="VehicleNo" name="VehicleNo" value="<?php echo@$VehicleNo; ?>" >
                            <span class="text-danger"><?php echo @$error['VehicleNo']; ?> </span>
                        </div>  
                    </div> 
                </div>
                <div class="row">                    
                    <div class="col">
                        <div class="mb-3">
                            <label for="DeliveryTo" class="form-label">Delivery To</label>
                            <textarea class="form-control" id="DeliveryTo" name="DeliveryTo" value="<?php echo@$DeliveryTo; ?>" rows="3" cols="50"><?php echo@$DeliveryTo; ?></textarea>
                            <span class="text-danger"><?php echo @$error['DeliveryTo']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Discription" class="form-label">Description</label>
                            <textarea class="form-control" id="Discription" name="Discription" value="<?php echo@$Discription; ?>" rows="3" cols="50"><?php echo@$Discription; ?></textarea>
                            <span class="text-danger"><?php echo @$error['Discription']; ?> </span>
                        </div>
                    </div>                     
                    <div class="col">
                        <div class="mb-3">
                            <label for="Remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="Remarks" name="Remarks" value="<?php echo@$Remarks; ?>" rows="3" cols="50"><?php echo@$Remarks; ?></textarea>
                            <span class="text-danger"><?php echo @$error['Remarks']; ?> </span>
                        </div>
                    </div>                 
                </div>               
                <div class="card-footer">
                    <input type="hidden" name="InternalId" value="<?php echo $InternalId; ?>">
                    <input type="hidden" name="operate" value="update">
                    <center><button style="background: #778899; color: white; width:150px " type="submit" class="btn ashs2">Update</button></center>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
include '../footer.php';
ob_flush();
?>    