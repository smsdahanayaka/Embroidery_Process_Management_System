<?php
ob_start();
include '../header.php';
include '../db_connection.php';
extract($_POST);
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Material Stocks | Out </h3>

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

        $Qt = dataClean($Qt);
        if (empty($Qt)) {
            $error['Qt'] = "Stock Quantity should not be blank!";
        }


        if (!empty($Qt) && $Qt2 < $Qt) {
            $error['Qt'] = "not enough Quantity in the stocks!";
        }

        if (empty($error)) {

            $RecordeStatus = "Active";
            $sql1 = "INSERT INTO materials_stocks_out (MaterialID,Qt,StockOutDate,StockOutTime,HandoverTo)VALUES('$MaterialID','$Qt','$StockOutDate','$StockOutTime','$HandoverTo')";
            $conn->query($sql1);

            $Qt3 = $Qt2 - $Qt;
            $sql2 = "UPDATE materials SET Qt='$Qt3' WHERE InternalId = '$InternalId'";
            $conn->query($sql2);
            $Qt = $HandoverTo = null;

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);


            $notifaction = "Material Used ";
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
                                <label for="Qt" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="Qt" name="Qt" value="<?php echo@$Qt; ?>" >
                                <span class="text-danger"><?php echo @$error['Qt']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="StockOutDate" class="form-label">Stock Out Date</label>
                                <input type="text" class="form-control" id="StockOutDate" name="StockOutDate" value="<?php echo date("Y/m/d"); ?>" readonly>
                                <span class="text-danger"><?php echo @$error['StockOutDate']; ?> </span>
                            </div>                        
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="StockOutTime" class="form-label">Stock Out Time	</label>
                                <input type="text" class="form-control" id="StockOutTime" name="StockOutTime" value="<?php
                                date_default_timezone_set("Asia/Colombo");
                                echo @date("h:i:sa")
                                ?>" readonly>
                                <span class="text-danger"><?php echo @$error['StockOutTime']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="HandoverTo" class="form-label">Handover To</label>
                                <input type="text" class="form-control" id="Remarks" name="HandoverTo" value="<?php echo@$HandoverTo; ?>" >
                                <span class="text-danger"><?php echo @$error['HandoverTo']; ?> </span>
                            </div>
                        </div>
                    </div>               
                    <div class="card-footer d-flex justify-content-center " style="" >
                        <input type="hidden" name="InternalId" value="<?php echo $InternalId; ?>">
                        <input type="hidden" name="operate" value="update">
                        <button  style="background: #778899; color: white;" type="submit" class="btn ashs2 m-2"  ><i class="fas fa-save"></i></button>
                        <button style="background: #778899; color: white;" type="reset" class="btn ashs2  m-2"><i class="fas fa-undo-alt"></i></button>
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
        <tr style="background-color:#646a70; color: white;  vertical-align: middle; height: 40px;">
            <th>Material ID</th>
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