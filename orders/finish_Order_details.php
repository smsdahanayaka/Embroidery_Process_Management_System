<?php
include '../header.php';
include '../db_connection.php';
?>
<!--title section-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Order Details | Finish Orders </h3>
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; margin-left: 30%;" >
<!--    <a href="</?php echo site_url; ?>orders/order_details.php" class="btn"style="background: #297F87; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>-->

</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <!--  data Input section  Start-->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        extract($_POST);

        $error = array();

        $FinishDate = dataClean($FinishDate);
        if (empty($FinishDate)) {
            $error['FinishDate'] = "Order finish date should not be blank...!";
        }

        $OrderId = dataClean($OrderId);
        if (empty($OrderId)) {
            $error['OrderId'] = "Order ID should not be blank...!";
        }


        $DamagedPcs = dataClean($DamagedPcs);
        if (empty($DamagedPcs)) {
            $error['DamagedPcs'] = "Please Enter the order quantity of Damaged pieces";
        }

        if (empty($error)) {

            $sql8 = "SELECT * FROM orderdetails WHERE OrderId = '$OrderId'";
            $result8 = $conn->query($sql8);
            $row = $result8->fetch_assoc();
            @$Qty = $row['Qty'];

            @$GoodPcs = $Qty - $DamagedPcs;
            @$damagedPresentage = ($DamagedPcs / $Qty) * 100;

            $Status = "Finish";
            $sql1 = "INSERT INTO finished_order_details(OrderId,FinishDate,GoodPcs,DamagedPcs,DamagePresentage,Remarks) VALUES('$OrderId','$FinishDate','$GoodPcs','$DamagedPcs','$damagedPresentage','$Remarks')";
            $conn->query($sql1);
            $sql2 = "UPDATE orderdetails SET Status='$Status' WHERE OrderId  = '$OrderId'";
            $conn->query($sql2);

            $notifaction = "order is Finished";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $sql7 = "INSERT INTO notifications (operationId,message,date,time,status) VALUES('$OrderId','$notifaction','$date','$time','$notifactionId')";
            $conn->query($sql7);

            $user = "94717788845";
            $password = "1551";
            $Message = "Your Order has been Ready to Deliver (".$OrderId.")";
            $text = urlencode($Message);
            $to = "94717788845";

            $baseurl = "http://www.textit.biz/sendmsg";
            $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
            $ret = file($url);

            $res = explode(":", $ret[0]);

            if (trim($res[0]) == "OK") {
                 "Message Sent - ID : " . $res[1];
            } else {
                 "Sent Failed - Error : " . $res[1];
            }

            $OrderId = $FinishDate = $GoodPcs = $DamagedPcs = $Remarks = null;
        }
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
                                <?php
                                $sql = "SELECT * FROM orderdetails WHERE Status='Ongoing' ";
                                $result = $conn->query($sql);
                                ?>
                                <label for="OrderId" class="form-label">Order Id</label>
                                <select class="form-select" aria-label="Default select example" name="OrderId" id="OrderId">
                                    <option>--Select Order Id--</option>
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
                                <label for="DamagedPcs" class="form-label">Damaged Pcs</label>
                                <input type="number" class="form-control" id="DamagedPcs" name="DamagedPcs" value="<?php echo@$DamagedPcs; ?>" >
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['DamagedPcs']; ?> </span>
                            </div>  
                        </div> 
                        <div class="col">
                            <div class="mb-3">
                                <label for="Remarks" class="form-label">Remarks</label>
                                <textarea class="form-control"  id="Remarks" name="Remarks" rows="1" cols="50" value="<?php echo@$Remarks; ?>" ></textarea>                                 
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['Remarks']; ?> </span>
                            </div>  
                        </div> 
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
                                <button style="background: #778899; color: white;" type="submit" class="btn ashs2" ><i class="fas fa-save"></i></button>
                                <button style="background: #778899; color: white;" type="reset" class="btn ashs2"><i class="fas fa-undo-alt"></i></button>
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
$sql = "SELECT * FROM finished_order_details ";
$result = $conn->query($sql);
?>
<div class="container">
    <table>
        <tr>
            <td> <h6>Number of Rows</h6>  </td>
            <td> <div class="form-group">
                    <select name="state" id="maxRows" class="form-control" style="width:100px; height: 35px;">
                        <option value="5000">show All</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="75">75</option>
                        <option value="100">100</option>
                    </select>     
                </div>
            </td>
        </tr>
    </table>   
</div>
<table class="table table-hover table-sm table-bordered" id="myTable2">
    <thead>
        <tr style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;">
            <th style="font-size: 13px; text-align: center; ">Order Id</th>
            <th style="font-size: 13px; text-align: center; ">Finish Date</th>            
            <th style="font-size: 13px; text-align: center; ">Good Pcs</th>
            <th style="font-size: 13px; text-align: center; ">Damaged Pcs</th>
            <th style="font-size: 13px; text-align: center; ">Damaged %</th>
            <th style="font-size: 13px; text-align: center; ">Remarks</th>    
            <th style="font-size: 13px; ">Edit</th> 
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td style="font-size: 12px; font-weight: bold;  vertical-align: middle; text-align: center;"><?php echo $row['OrderId'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['FinishDate'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['GoodPcs'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['DamagedPcs'] ?></td>
                    <td style="font-size: 12px; font-weight: bold;  vertical-align: middle; text-align: center;"><?php echo $row['DamagePresentage'] ?>%</td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td>

                    <td >
                        <form method="post" action="<?php echo site_url; ?>orders/finish_Order_details_Update.php">
                            <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                            <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-edit"></i></button>
                        </form>

                    </td>

                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>  
<div class="pagination-container">
    <nav  aria-label="Page navigation example">
        <ul class="pagination justify-content-end" ></ul>
    </nav>        
</div>
<?php
include '../footer.php';
?> 
<script>
    function removeRecord(form_id) {
        swal({
            title: "Are you sure?",
            text: "Once remove, you will not be able to view this record here!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById(form_id).submit();
                    } else {
                        swal("Your Record is safe!");
                    }
                });
    }
</script>