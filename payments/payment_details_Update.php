<?php
include '../header.php';
include '../db_connection.php';
extract($_POST);
?>
<!--title section-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Payments Details | Update </h3>

    <a href="<?php echo site_url; ?>payments/payments.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>

</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <!--  data Input section  Start-->
    <?php
    extract($_POST);    
    $error = array();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$operate == "update") {

        $FinishDate = dataClean($PaymentDate);
        if (empty($PaymentDate)) {
            $error['PaymentDate'] = "Order finish date should not be blank...!";
        }
        if (empty($error)) {
            $sql = "UPDATE transactions SET BuyerID='$BuyerID',PaymentDate='$PaymentDate',Amount='$Amount',Remarks='$Remarks' WHERE InternalId2 = '$InternalId2'";
            $conn->query($sql);
            // header("Location:order_details.php");
        }
    }
    $sql = "SELECT * FROM transactions WHERE InternalId2 ='$InternalId2'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $InternalId2 = $row['InternalId2'];
        $PaymentID = $row['PaymentID'];
        $BuyerID2 = $row['BuyerID'];
        $PaymentDate = $row['PaymentDate'];
        $Amount = $row['Amount'];
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
                                <label for="PaymentID" class="form-label">Payment ID</label>
                                <input type="text" class="form-control" id="PaymentID" name="PaymentID" title="Fromat Should be like 'PAY000000' " onkeyup="this.value = this.value.toUpperCase();" value="<?php echo@$PaymentID; ?>" >
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['PaymentID']; ?> </span>
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
                                    <option value="<?php echo $BuyerID2; ?>"><?php echo $BuyerID2; ?></option>

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
                                <span class="text-danger"><?php echo @$error['BuyerID']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                             <div class="mb-3">
                                <label for="PaymentDate" class="form-label">Payment Date</label>
                                <input type="date" class="form-control" id="PaymentDate"  name="PaymentDate" style="width:150px " value="<?php echo@$PaymentDate; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['PaymentDate']; ?> </span>
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
                                <textarea class="form-control"  id="Remarks" name="Remarks" rows="1" cols="50" value="<?php echo@$Remarks; ?>" ><?php echo@$Remarks; ?></textarea>                                 
                                <span class="text-danger" style="font-size:40px;"><?php echo @$error['Remarks']; ?> </span>
                            </div>  
                        </div> 
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 10px;">
                                <input type="hidden" name="InternalId2" value="<?php echo $InternalId2; ?>">
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
//$sql = "SELECT * FROM transactions LEFT JOIN buyerdetails ON buyerdetails.BuyerID = transactions.BuyerID WHERE InternalId ='$InternalId'";
$sql = "SELECT * FROM transactions LEFT JOIN buyerdetails ON  buyerdetails.BuyerID = transactions.BuyerID WHERE InternalId2 ='$InternalId2'";
$result = $conn->query($sql);
?>
<table class="table table-hover table-sm table-bordered" id="myTable2">
    <thead>
        <tr style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;">
            <th style="font-size: 13px; text-align: center; ">Payment ID</th> 
            <th style="font-size: 13px; text-align: center; ">Buyer ID</th> 
            <th style="font-size: 13px; text-align: center; ">Buyer Name</th>            
            <th style="font-size: 13px; text-align: center; ">Payment Date</th>
            <th style="font-size: 13px; text-align: center; ">Amount</th>
            <th style="font-size: 13px; text-align: center; ">Remarks</th>    
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr >
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['PaymentID'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerID'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['PaymentDate'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: right; padding-right: 30px;"><?php echo $row['Amount'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td>                 

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
