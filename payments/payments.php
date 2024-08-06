<?php
ob_start();
include '../header.php';
include '../db_connection.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Payments Details</h3>
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; margin-left: 30%;" >
</div>
<!--New Payment Insert Start here-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">

    <?php
    extract($_POST);
    @$BuyerID = $BuyerID;
    $sql = "SELECT * FROM payment_details WHERE BuyerID ='$BuyerID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        @$Paid_Total = $row['Paid_Total'];
        @$Invoice_total = $row['Invoice_total'];
        @$BalancePayment = $row['BalancePayment'];
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        extract($_POST);
        $error = array();


        if (empty($BuyerID)) {
            $error['BuyerID'] = "Please Select a Buyer Id";
        }
        if (empty($PaymentDate)) {
            $error['PaymentDate'] = "The Payment Date should not be blank!";
        }

        $Amount = dataClean($Amount);
        if (empty($Amount)) {
            $error['Amount'] = "The Buyer name should not be blank!";
        }

        if (empty($error)) {
            $RecordeStatus = "Active";
            $sql1 = "INSERT INTO transactions(PaymentID,BuyerID,PaymentDate,Amount,Remarks,RecordeStatus) VALUES('$PaymentID','$BuyerID','$PaymentDate','$Amount','$Remarks','$RecordeStatus')";
            $conn->query($sql1);

            @$Paid_Total = $Paid_Total + $Amount;
            @$BalancePayment = $Paid_Total - $Invoice_total;

            $sql2 = "UPDATE payment_details SET Paid_Total ='$Paid_Total',BalancePayment='$BalancePayment' WHERE BuyerID = '$BuyerID'";
            $conn->query($sql2);

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);


            $notifaction = "New Payment added";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $activityDoneBy = "By " . $fiestname . " " . $lastName;
            $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
            $conn->query($sql7);
            $BuyerID = $PaymentDate = $PaymentID = $Amount = $Remarks = $RecordeStatus = null;
        }
        header("Location:payments.php");
    }
    ?>
    <div >

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="PaymentID" class="form-label">New Payment ID</label>
                                <input type="text" class="form-control" id="PaymentID" name="PaymentID"  value="<?php echo idGenerator('PAY', 'transactions', 'PaymentID', 'PaymentID'); ?>" style="width:130px " readonly>
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['PaymentID']; ?> </span>
                            </div>   
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <?php
                                $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                                $result = $conn->query($sql);
                                ?>
                                <label for="BuyerID" class="form-label">Buyer ID</label>
                                <select style="width:160px " class="form-select" aria-label="Default select example" name="BuyerID" id="BuyerID" onchange="getOrderIds()">
                                    <option value="">Select Buyer ID</option>
                                    <?php
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            ?>                                    
                                            <option value="<?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span style="font-size:12px;" class="text-danger"><?php echo @$error['BuyerID']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="PaymentDate" class="form-label">Payment Date</label>
                                <input type="date" class="form-control" id="PaymentDate"  name="PaymentDate" style="width:150px " value="<?php echo@$PaymentDate; ?>">
                                <span style="font-size:12px;" class="text-danger"style="font-size:12px;" ><?php echo @$error['PaymentDate']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="Amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="Amount"  name="Amount" value="<?php echo@$Amount; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['Amount']; ?> </span>
                            </div>
                        </div> 
                        <div class="col">
                            <div class="mb-3">
                                <label for="Remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="Remarks" name="Remarks" value="<?php echo@$Remarks; ?>" rows="1" cols="70"><?php echo@$SampleDescription; ?></textarea>
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['Remarks']; ?> </span>
                            </div>
                        </div> 
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
                                <button style="background: #778899; color: white;" type="submit" class="btn ashs2 " ><i class="fas fa-save"></i></button>
                                <button style="background: #778899; color: white;" type="reset" class="btn ashs2"><i class="fas fa-undo-alt"></i></button>
                            </div> 
                        </div>                                            
                    </div>                          
                </div>
            </div>
        </form>
    </div>

</div>
<!--New Payment Insert End here-->
<?php
$sql = "SELECT * FROM transactions LEFT JOIN buyerdetails ON  buyerdetails.BuyerID = transactions.BuyerID WHERE RecordeStatus = 'Active'";
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
            <th style="font-size: 13px; text-align: center; ">Payment ID</th> 
            <th style="font-size: 13px; text-align: center; ">Buyer ID</th> 
            <th style="font-size: 13px; text-align: center; ">Buyer Name</th>            
            <th style="font-size: 13px; text-align: center; ">Payment Date</th>
            <th style="font-size: 13px; text-align: center; ">Amount</th>
            <th style="font-size: 13px; text-align: center; ">Remarks</th>
            <th style="font-size: 13px; text-align: center; width:50px ; " >Edit</th>
            <th style="font-size: 13px; text-align: center; width:10px ; ">Remove</th>


        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr >
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['PaymentID'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerID'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['PaymentDate'] ?></td>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: right; padding-right: 30px;"><?php echo $row['Amount'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td> 
                    <td align="center">
                        <form method="post" action="<?php echo site_url; ?>payments/payment_details_Update.php">
                            <input type="hidden" name="InternalId2" value="<?php echo $row['InternalId2']; ?>">
                            <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-edit"></i></button>
                        </form>

                    </td>

                    <td align="center" >
                        <form  id="remove_form<?php echo $row['InternalId2']; ?>" method="post" action="<?php echo site_url; ?>payments/remove.php">
                            <input type="hidden" name="InternalId2" value="<?php echo $row['InternalId2']; ?>">
                            <button  style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="button" onclick="removeRecord('remove_form<?php echo $row['InternalId2']; ?>')"><i class="fas fa-minus-circle"></i></button>
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
ob_flush();
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