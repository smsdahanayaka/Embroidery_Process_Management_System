<?php
ob_start();
include '../header.php';
include '../db_connection.php';
extract($_POST);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Material Stocks | In </h3>

    <a href="<?php echo site_url; ?>material_stocks/total_stocks.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>

</div>
<!--Update Matrial  Start here-->
<div>
    <?php
    extract($_POST);
//echo $InternalId;
    $sql = "SELECT * FROM materials WHERE InternalId ='$InternalId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $InternalId = $row['InternalId'];
        $MaterialID = $row['MaterialID'];
        $Qt2 = $row['Qt'];
    }



    $error = array();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$operate == "update") {

        $StockInDate = dataClean($StockInDate);
        if (empty($StockInDate)) {
            $error['StockInDate'] = "stock in date should not be blank...!";
        }

        $Qt = dataClean($Qt);
        if (empty($Qt)) {
            $error['Qt'] = "please enter the Quantity ...!";
        }

        $SupplerTP = dataClean($SupplerTP);
        if (!empty($SupplerTP)) {
            if (strlen($SupplerTP) != 10) {
                $error['SupplerTP'] = "The Invalid Mobile Number...!";
            }
        }
        $SupplerEmail = dataClean($SupplerEmail);
        if (!empty($SupplerEmail)) {
            if (!filter_var($SupplerEmail, FILTER_VALIDATE_EMAIL)) {
                $error['SupplerEmail'] = "Invalid email format";
            }
        }

        if (empty($error)) {

            $RecordeStatus = "Active";
            $sql1 = "INSERT INTO materials_stocks_in (MaterialID,StockInDate,Qt,Remarks,SupplerName,SupplerTP,SupplerEmail,SupplerAddress,RecordeStatus)VALUES('$MaterialID','$StockInDate','$Qt','$Remarks','$SupplerName','$SupplerTP','$SupplerEmail','$SupplerAddress','$RecordeStatus')";
            $conn->query($sql1);

            $Qt3 = $Qt + $Qt2;
            $sql2 = "UPDATE materials SET Qt='$Qt3' WHERE InternalId = '$InternalId'";
            $conn->query($sql2);
            $StockInDate = $Qt = $Remarks = $SupplerTP = $SupplerEmail = $SupplerAddress = $SupplerName = null;

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);

            $notifaction = "Material Stocks added ";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $activityDoneBy = "By " . $fiestname . " " . $lastName;
            $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
            $conn->query($sql7);

            header("Location:total_stocks.php");
        }
    }
    ?>    
    <div class="card mt-2">
        <div >

        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
            <div class="card-body">

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="MaterialID" class="form-label">Material ID</label>
                                <input type="text" class="form-control" id="MaterialID" name="MaterialID" value="<?php echo@$MaterialID; ?>" readonly>
                                <span class="text-danger"><?php echo @$error['MaterialID']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="StockInDate" class="form-label">Stock in Date</label>
                                <input type="date" class="form-control" id="StockInDate" name="StockInDate" value="<?php echo@$StockInDate; ?>" >
                                <span class="text-danger"><?php echo @$error['StockInDate']; ?> </span>
                            </div>                        
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="Qt" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="Qt" name="Qt" value="<?php echo@$Qt; ?>" >
                                <span class="text-danger"><?php echo @$error['Qt']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="Remarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="Remarks" name="Remarks" value="<?php echo@$Remarks; ?>" >
                                <span class="text-danger"><?php echo @$error['Remarks']; ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="SupplerName" class="form-label">Suppler Name</label>
                                <input type="text" class="form-control" id="SupplerName" name="SupplerName" value="<?php echo@$SupplerName; ?>" >
                                <span class="text-danger"><?php echo @$error['SupplerName']; ?> </span>
                            </div>                        
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="SupplerTP" class="form-label">Telephone</label>
                                <input type="text" class="form-control" maxlength="10"  id="SupplerTP" name="SupplerTP" value="<?php echo@$SupplerTP; ?>" >
                                <span class="text-danger"><?php echo @$error['SupplerTP']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="SupplerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="SupplerEmail" name="SupplerEmail" value="<?php echo@$SupplerEmail; ?>" >
                                <span class="text-danger"><?php echo @$error['SupplerEmail']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="SupplerAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="SupplerAddress" name="SupplerAddress" value="<?php echo@$SupplerAddress; ?>">
                                <span class="text-danger"><?php echo @$error['SupplerAddress']; ?> </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <input type="hidden" name="InternalId" value="<?php echo $InternalId; ?>">
                        <input type="hidden" name="operate" value="update">
                        <button style="background: #778899; color: white;" type="submit" class="btn ashs2 m-2"><i class="fas fa-save"></i></button>
                        <button style="background: #778899; color: white;" type="reset" class="btn ashs2 m-2"><i class="fas fa-undo-alt"></i></button>
                    </div>
                </div>
            </div>                      
        </form>
    </div>

</div>
<!--Update Matrial  End here-->
<?php
$sql = "SELECT * FROM materials WHERE InternalId  = '$InternalId'";
$result = $conn->query($sql);
?>
<h5 style="padding-top:10px; padding-bottom: 10px; ">Present Quantity</h5>
<table class="table table-hover table-sm">
    <thead>
        <tr style="background-color:#646a70; color: white; vertical-align: middle; height: 40px;">
            <th >Material ID</th>
            <th>Material Name</th>
            <th>UoM</th>
            <th>Quantity</th>        
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr >
                    <td><?php echo $row['MaterialID'] ?></td>
                    <td><?php echo $row['MaterialName'] ?></td>
                    <td><?php echo $row['UoM'] ?></td>
                    <td><?php echo $row['Qt'] ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table> 

<?php
include '../footer.php';
ob_flush();
?> 