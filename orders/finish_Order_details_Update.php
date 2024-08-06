<?php
include '../header.php';
include '../db_connection.php';
?>
<!--title section-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Order Details | Finish Orders | Update </h3>

    <a href="<?php echo site_url; ?>orders/finish_Order_details.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>

</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <!--  data Input section  Start-->
    <?php
    extract($_POST);

    $error = array();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$operate == "update") {

        $FinishDate = dataClean($FinishDate);
        if (empty($FinishDate)) {
            $error['FinishDate'] = "Order finish date should not be blank...!";
        }

        $OrderId = dataClean($OrderId);
        if (empty($OrderId)) {
            $error['OrderId'] = "Order ID should not be blank...!";
        }

        $GoodPcs = dataClean($GoodPcs);
        if (empty($GoodPcs)) {
            $error['GoodPcs'] = "Please Enter the order quantity of Good pieces";
        }
        $DamagedPcs = dataClean($DamagedPcs);
        if (empty($DamagedPcs)) {
            $error['DamagedPcs'] = "Please Enter the order quantity of Damaged pieces";
        }

        if (empty($error)) {
            $sql = "UPDATE finished_order_details SET OrderId='$OrderId',FinishDate='$FinishDate',GoodPcs='$GoodPcs',DamagedPcs='$DamagedPcs',Remarks='$Remarks' WHERE InternalId = '$InternalId'";
            $conn->query($sql);
            // header("Location:order_details.php");
        }
    }
    $sql = "SELECT * FROM finished_order_details WHERE InternalId ='$InternalId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $InternalId = $row['InternalId'];
        $OrderId = $row['OrderId'];
        $FinishDate = $row['FinishDate'];
        $GoodPcs = $row['GoodPcs'];
        $DamagedPcs = $row['DamagedPcs'];
        $Remarks = $row['Remarks'];
    }
    ?>
    <div >
        <div >
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="OrderId" class="form-label">Order ID</label>
                                <input type="text" class="form-control" id="OrderId" name="OrderId" title="Fromat Should be like 'ORD000000' " onkeyup="this.value = this.value.toUpperCase();" value="<?php echo@$OrderId; ?>" >
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['OrderId']; ?> </span>
                            </div>   
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="FinishDate" class="form-label">Finish Date</label>
                                <input type="date" class="form-control" id="FinishDate" name="FinishDate" value="<?php echo@$FinishDate; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['FinishDate']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="GoodPcs" class="form-label" >Good Pcs</label>
                                <input type="number" class="form-control" id="GoodPcs" name="GoodPcs" value="<?php echo@$GoodPcs; ?>" >
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['GoodPcs']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="DamagedPcs" class="form-label">Damaged Pcs</label>
                                <input type="number" class="form-control" id="DamagedPcs" name="DamagedPcs" value="<?php echo@$DamagedPcs; ?>" >
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['DamagedPcs']; ?> </span>
                            </div>  
                        </div>   
                        <div class="col">
                            <div class="mb-3">
                                <label for="Remarks" class="form-label">Remarks</label>
                                <textarea class="form-control"  id="Remarks" name="Remarks" rows="1" cols="50" value="<?php echo@$Remarks; ?>" ><?php echo@$Remarks; ?></textarea>                                 
                                <span class="text-danger" style="font-size:40px;"><?php echo @$error['Remarks']; ?> </span>
                            </div>  
                        </div> 
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 10px;">
                                <input type="hidden" name="InternalId" value="<?php echo $InternalId; ?>">
                                <input type="hidden" name="operate" value="update">
                                <button style="background: #778899; color: white;" type="submit" class="btn ashs2" ><i class="fas fa-save"></i></button>                                
                            </div> 
                        </div> 
                    </div>                          
                </div>
            </div>
        </form>
    </div>
    <!--  data Input section  END-->
</div>
<?php
$sql = "SELECT * FROM finished_order_details WHERE InternalId ='$InternalId'";
$result = $conn->query($sql);
?>
<table class="table table-hover table-sm">
    <thead>
        <tr style="background-color:#646a70; color: white; vertical-align: middle; height: 40px;">
            <th>Order Id</th>
            <th>Finish Date</th>            
            <th>Good Pcs</th>
            <th>Damaged Pcs</th>
            <th>Remarks</th>    
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td><?php echo $row['OrderId'] ?></td>
                    <td><?php echo $row['FinishDate'] ?></td>
                    <td><?php echo $row['GoodPcs'] ?></td>
                    <td><?php echo $row['DamagedPcs'] ?></td>
                    <td><?php echo $row['Remarks'] ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>  

<?php
include '../footer.php';
?> 
