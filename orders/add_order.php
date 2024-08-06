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

    $OrderDate = dataClean($OrderDate);
    if (empty($OrderDate)) {
        $error['OrderDate'] = "Order date should not be blank...!";
    }
   
     if (empty($BuyerID)) {
        $error['BuyerID'] = "Please Select a Buyer Id";
    }
    
    $Qty = dataClean($Qty);
    if (empty($Qty)) {
        $error['Qty'] = "Please Enter the order quantity";
    }

    if (empty($Status)) {
        $error['Status'] = "Selet the order ststus!";
    }



    if (empty($error)) {
        $target_dir = "../order_images/";
        $target_file = $target_dir . rand() . "." . pathinfo($_FILES["Artwork"]["name"], PATHINFO_EXTENSION);

        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($_FILES["Artwork"]["name"], PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Artwork"]["tmp_name"]);
        if ($check !== false) {

            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["Artwork"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "eps" && $imageFileType != "svg") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["Artwork"]["tmp_name"], $target_file)) {
                $BuyerID = str_replace(' ', '', $BuyerID);
                $Artwork = htmlspecialchars($target_file);
                $RecordeStatus = "Active";
                $sql = "INSERT INTO orderdetails(OrderId,OrderDate,BuyerID,OrderDescription,Cost,StyleNo,BundleNumber,Qty,Ordermaterial,Artwork,Remarks,Status,RecordeStatus) VALUES('$OrderId','$OrderDate','$BuyerID','$OrderDescription','$Cost','$StyleNo','$BundleNumber','$Qty','$Ordermaterial','$Artwork','$Remarks','$Status','$RecordeStatus')";
                $conn->query($sql);

                $fiestname = str_replace(' ', '', $fiestname);
                $lastName = str_replace(' ', '', $lastName);

                $notifaction = "New Order added";
                $notifactionId = "0";
                $date = date("Y-m-d h:i:sa");
                date_default_timezone_set("Asia/Colombo");
                $time = date("h:i:sa");
                $activityDoneBy = "By " . $fiestname . " " . $lastName;
                $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
                $conn->query($sql7);

                $sql9 = "UPDATE samples SET OrderId ='$OrderId' WHERE SampleId = '$SampleId'";
                $conn->query($sql9);

                $user = "94717788845";
                $password = "1551";
                $Message = "Your Order in progress (" . $OrderId . ")";
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



                $SampleId = $Date = $BuyerID = $SampleDescription = $RecordeStatus = null;
                header("Location:order_details.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>




<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-2 border-bottom">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Order Details | Add </h3>
    <div>
        <a href="<?php echo site_url; ?>orders/order_details.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
</div>


<div class="card mt-2">
    <div class="card-header">
        New Order

    </div>
    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="card-body">

            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="OrderId" class="form-label">Order ID</label>
                            <input type="text" class="form-control" id="OrderId" name="OrderId" value="<?php echo idGenerator('ORD', 'orderdetails', 'OrderId', 'OrderId'); ?>" readonly >
                            <span class="text-danger"><?php echo @$error['OrderId']; ?> </span>
                        </div>   
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="OrderDate" class="form-label">Order Date</label>
                            <input type="date" class="form-control" id="OrderDate" name="OrderDate" value="<?php echo@$OrderDate; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['OrderDate']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <?php
                            $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                            $result = $conn->query($sql);
                            ?>
                            <label for="BuyerID" class="form-label">Buyer ID</label>
                            <button style="focus:outline:none" id="editBtn" type="button" class="btn btn-sm" onClick="document.location.reload(true)" hidden="hidden"><i class="fas fa-edit"></i></button>
                            <select class="form-select" aria-label="Default select example" name="BuyerID" id="BuyerID" onclick="getOrderIds()" onchange="dropDownChange()">                 
                                <option  value="">--Select Buyer ID--</option>
                                <?php
                                if ($result->num_rows > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                        ?>                                    
                                        <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
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
                            <label for="Qty" class="form-label">Qty</label>
                            <input type="number" class="form-control" id="Qty" name="Qty" value="<?php echo@$Qty; ?>" >
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Qty']; ?> </span>
                        </div>  
                    </div> 
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Cost" class="form-label">Cost-LKR</label>
                            <input type="number" class="form-control" id="Cost" name="Cost" min="0.00" max="10000000000.00" step="0.01" value="<?php echo@$Cost; ?>" >
                            <span class="text-danger"><?php echo @$error['Cost']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="BundleNumber" class="form-label">Bundle No.</label>
                            <input type="text" class="form-control" id="BundleNumber" name="BundleNumber" value="<?php echo @$BundleNumber; ?>" >
                            <span class="text-danger"><?php echo @$error['BundleNumber']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="StyleNo" class="form-label">Style No.</label>
                            <input type="text" class="form-control" id="StyleNo" name="StyleNo" value="<?php echo@$StyleNo; ?>" >
                            <span class="text-danger"><?php echo @$error['StyleNo']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Artwork" class="form-label">Artwork</label>
                            <input type="file" class="form-control" id="Artwork" name="Artwork" value="<?php echo@$Artwork; ?>" >
                            <span class="text-danger"><?php echo @$error['Artwork']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Status" class="form-label">Order Status</label>
                            <select class="form-select" aria-label="Default select example" name="Status" id="Status">
                                <option value="">--Select Status--</option>
                                <option value="Ongoing" <?php if (@$Status == 'Ongoing') { ?>selected<?php } ?> >Ongoing</option>
                                <option value="Pending" <?php if (@$Status == 'Pending') { ?>selected<?php } ?> >Pending</option>
                            </select>
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Status']; ?> </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">                          
                            <label for="SampleId" class="form-label">Sample Id</label>                            
                            <select class="form-control" name="SampleId" data-row-id="SampleId" id="SampleId"  >
                                <option value="">--Select Sample Id--</option>
                            </select>                           
                            <span class="text-danger"><?php echo @$error['SampleId']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="OrderDescription" class="form-label">Order Description</label>
                            <textarea class="form-control" id="OrderDescription" name="OrderDescription" value="<?php echo@$OrderDescription; ?>" rows="3" cols="50"><?php echo@$OrderDescription; ?> </textarea>
                            <span class="text-danger"><?php echo @$error['OrderDescription']; ?> </span>
                        </div>
                    </div>               
                    <div class="col">
                        <div class="mb-3">
                            <label for="Ordermaterial" class="form-label">Order Material</label>
                            <textarea class="form-control" id="Ordermaterial" name="Ordermaterial" value="<?php echo@$Ordermaterial; ?>" rows="3" cols="50"><?php echo@$Ordermaterial; ?> </textarea>
                            <span class="text-danger"><?php echo @$error['Ordermaterial']; ?> </span>
                        </div>
                    </div> 
                    <div class="col">
                        <div class="mb-3">
                            <label for="Remarks" class="form-label">Remarks</label>
                            <textarea class="form-control" id="Remarks" name="Remarks" value="<?php echo@$Remarks; ?>" rows="3" cols="50"><?php echo@$Remarks; ?> </textarea>
                            <span class="text-danger"><?php echo @$error['Remarks']; ?> </span>
                        </div>
                    </div> 
                </div>
                <div class="card-footer">
                    <center> <button style="background: #778899; color: white; width:150px " type="submit" class="btn ashs2">Save</button></center>
                </div>
            </div>

        </div>
    </form>

</div>

<?php
include '../footer.php';
ob_flush();
?> 
<script>
    function getOrderIds() {
        var BuyerID = $("#BuyerID").val();
        $.ajax({
            url: 'getSampleIdes.php',
            type: 'post',
            data: {BuyerID: BuyerID},
            dataType: 'json',
            success: function (response) {
                var len = response.length;
                $("#sel_user").empty();
                for (var i = 0; i < len; i++) {
                    var id = response[i]['SampleId'];
                    var name = response[i]['SampleId'];
                    $("#SampleId").append("<option value='" + id + "'>" + name + "</option>");
                }
            }//success
        });//ajax function to fatch the Order Data
    }



    function dropDownChange() {

        $('#BuyerID option:not(:selected)').prop('disabled', true);
        $("#add_row").removeAttr("hidden");
        $("#editBtn").removeAttr("hidden");

    }
</script>