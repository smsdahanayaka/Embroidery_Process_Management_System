<?php
ob_start();
include '../header.php';
include '../db_connection.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>  
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $error = array();

    $Date = dataClean($Date);
    if (empty($Date)) {
        $error['Date'] = "Date should not be blank!";
    }
    $OrderId = dataClean($OrderId);
    if (empty($OrderId)) {
        $error['OrderId'] = "OrderId should not be blank!";
    }
    $VehicleNo = dataClean($VehicleNo);
    if (empty($VehicleNo)) {
        $error['VehicleNo'] = "VehicleNo field should not be blank!";
    }
    $DeliveryTo = dataClean($DeliveryTo);
    if (empty($DeliveryTo)) {
        $error['DeliveryTo'] = "Delivery to field should not be blank!";
    }
    if (empty($Status)) {
        $error['Status'] = "The Status should not be blank!";
    }
    if (empty($error)) {
        $RecordeStatus = "Active";
        $sql = "INSERT INTO good_issue_note(GIR_Number,Date,OrderId,VehicleNo,DeliveryTo,Discription,Remarks,Status,RecordeStatus) VALUES('$GIR_Number','$Date','$OrderId','$VehicleNo','$DeliveryTo','$Discription','$Remarks','$Status','$RecordeStatus')";
        $conn->query($sql);
        $sql2 = "UPDATE orderdetails SET Status='$Status' WHERE OrderId  = '$OrderId'";
        $conn->query($sql2);

        $fiestname = str_replace(' ', '', $fiestname);
        $lastName = str_replace(' ', '', $lastName);

        $notifaction = "New GIN added";
        $notifactionId = "0";
        $date = date("Y-m-d h:i:sa");
        date_default_timezone_set("Asia/Colombo");
        $time = date("h:i:sa");
        $activityDoneBy = "By " . $fiestname . " " . $lastName;
        $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
        $conn->query($sql7);


        $GIR_Number = $Date = $OrderId = $VehicleNo = $DeliveryTo = $Discription = $Remarks = $Status = null;
        header("Location:good_issue_note.php");
    }
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-2 border-bottom">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Good Issue Note | Add </h3>
    <div>
        <a href="<?php echo site_url; ?>good_issue_notes/good_issue_note.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
</div>
<div class="card mt-2">
    <div class="card-header">
        New Good Issue Note

    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="card-body">

            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="GIR_Number" class="form-label">GIR Number</label>
                            <input type="text" class="form-control" id="GIR_Number" name="GIR_Number" value="<?php echo idGenerator('GIN', 'good_issue_note', 'GIR_Number', 'GIR_Number'); ?>" readonly >
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
                            <?php
                            $sql = "SELECT * FROM orderdetails WHERE RecordeStatus ='Active' AND Status = 'Finish' ";
                            $result = $conn->query($sql);
                            ?>
                            <label for="OrderId" class="form-label">Order Id</label>
                            <select class="form-select" aria-label="Default select example" name="OrderId" id="OrderId">
                                <option>--Select Order ID--</option>                                    
                                <?php
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                        ?>                                    
                                        <option value=" <?php echo $row['OrderId'] ?>" <?php if ($row['OrderId'] == @$OrderId) { ?> selected <?php } ?>> <?php echo $row['OrderId'] ?> </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>                                                       
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
                    <div class="col">
                        <div class="mb-3">
                            <label for="Status" class="form-label">Status</label>
                            <select class="form-select" aria-label="Default select example" name="Status" id="Status">
                                <option value="">--Select Status--</option>
                                <option value="Delivered" <?php if (@$Status == 'Delivered') { ?>selected<?php } ?> >Delivered</option>                                
                            </select>
                            <span class="text-danger"><?php echo @$error['Status']; ?> </span>
                        </div>
                    </div>
                </div>                

                <div class="card-footer">
                    <center> <button style="background: #778899; color: white; width: 150px" type="submit" class="btn ashs2">Save</button></center>
                </div>
            </div>

        </div>
    </form>

</div>

<?php
include '../footer.php';
ob_flush();
?>    