<?php
ob_start();
include '../header.php';
include '../db_connection.php';
//include '../config.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>  
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $error = array();

    if (empty($Title)) {
        $error['Title'] = "The title should not be blank!";
    }

    $BuyerName = dataClean($BuyerName);
    if (empty($BuyerName)) {
        $error['BuyerName'] = "The Buyer name should not be blank!";
    }


    $NIC_BRNo = dataClean($NIC_BRNo);
    if (empty($NIC_BRNo)) {
        $error['NIC_BRNo'] = "The Buyer's NIC or BR No. should not be blank!";
    }


    $Address = dataClean($Address);
    if (empty($Address)) {
        $error['Address'] = "The Buyer's Address should not be blank!";
    }


    $Telephone = dataClean($Telephone);
    if (empty($Telephone)) {
        $error['Telephone'] = "The Buyer's Telephone Number should not be blank!";
    }

    if (!empty($Telephone)) {
        if (strlen($Telephone) != 10) {
            $error['Telephone'] = "The Invalid Telephone Number!";
        }
    }

    $Mobile = dataClean($Mobile);
    if (empty($Mobile)) {
        $error['Mobile'] = "The Buyer's Telephone Number should not be blank!";
    }

    if (!empty($Mobile)) {
        if (strlen($Mobile) != 10) {
            $error['Mobile'] = "The Invalid Mobile Number!";
        }
    }
    if (!empty($FaxNo)) {
        if (strlen($FaxNo) != 10) {
            $error['FaxNo'] = "The Invalid Fax Number!";
        }
    }
    if (!empty($ContactPersonNumber)) {
        if (strlen($ContactPersonNumber) != 10) {
            $error['ContactPersonNumber'] = "The Invalid Mobile Number!";
        }
    }

    $Email = dataClean($Email); // primary validation ---(1) check the email field is empty
    if (empty($Email)) {
        $error['Email'] = "Email is required";
    }

    if (!empty($Email)) { // secondery validation -- (2) check the Email format ok or not
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $error['Email'] = "Invalid email format";
        }
    }
    if (!empty($Email)) { // third validation -- (3) check the email already in the database
        $sql = "SELECT * FROM buyerdetails WHERE Email='$Email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { // methanadi ekakata wada wadipura thiyeda balanawa
            $error['Email'] = "This email address is already being used!";
        }
    }

    $Website = dataClean($Website); // primary validation ---(1) check the email field is empty
    if (!empty($Website) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $Website)) {
        $error['Website'] = "Invalid URL";
    }
    if (empty($error)) {
        $UseStstus = "Active";
        $sql = "INSERT INTO buyerdetails(BuyerID,Title,BuyerName,NIC_BRNo,Address,Email,Telephone,Mobile,FaxNo,Website,ContactPersonName,ContactPersonNumber,RegisteredDate,UseStstus) VALUES('$BuyerID','$Title','$BuyerName','$NIC_BRNo','$Address','$Email','$Telephone','$Mobile','$FaxNo','$Website','$ContactPersonName','$ContactPersonNumber','$RegisteredDate','$UseStstus')";
        $conn->query($sql);
        $RecordStatus = "Active";
        $sql2 = "INSERT INTO payment_details(BuyerID,) VALUES('$BuyerID','$RecordStatus')";
        $conn->query($sql2);

        $sql5 = "INSERT INTO payment_details(BuyerID) VALUES('$BuyerID')";
        $conn->query($sql5);

        $fiestname = str_replace(' ', '', $fiestname);
        $lastName = str_replace(' ', '', $lastName);

        $notifaction = "New Buyer added";
        $notifactionId = "0";
        $date = date("Y-m-d h:i:sa");
        date_default_timezone_set("Asia/Colombo");
        $time = date("h:i:sa");
        $activityDoneBy = "By " . $fiestname . " " . $lastName;
        $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
        $conn->query($sql7);

        header("Location:buyers_details_admin.php");
    }
}
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-2 border-bottom">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Buyer Details | Add </h3>
    <div>
        <a href="<?php echo site_url; ?>buyers/buyers_details_admin.php" class="btn green ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
</div>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="card mt-2">
        <div class="card-header">
            New Buyer &nbsp;&nbsp;&nbsp;<div class="col">
                <div class="mb-3">                        
                    <input style="margin-top: 10px; width: 150px" type="text" class="form-control" id="BuyerID" name="BuyerID" value="<?php echo idGenerator('BUY', 'buyerdetails', 'BuyerID', 'BuyerID'); ?>" readonly style="width: 130px;" >
                    <span style="font-size:12px;" class="text-danger"><?php echo @$error['BuyerID']; ?> </span>
                </div>    
            </div> 
        </div>

        <div class="card-body">

            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Title" class="form-label">Title</label>
                            <select class="form-select" aria-label="Default select example" name="Title" id="Title">
                                <option value="">--Select Title--</option>
                                <option value="Mr." <?php if (@$Title == 'Mr.') { ?>selected<?php } ?> >Mr.</option>
                                <option value="Mrs." <?php if (@$Title == 'Mrs.') { ?>selected<?php } ?>>Mrs.</option>
                                <option value="Miss." <?php if (@$Title == 'Mr.') { ?>selected<?php } ?>>Miss.</option>
                            </select>
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Title']; ?> </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="BuyerName" class="form-label">Buyer's Name</label>
                            <input type="text" class="form-control" id="BuyerName" name="BuyerName" value="<?php echo@$BuyerName; ?>" >
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['BuyerName']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="RegisteredDate" class="form-label">Register Date</label>
                            <input type="date" class="form-control" id="RegisteredDate" name="RegisteredDate" value="<?php echo@$RegisteredDate; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['RegisteredDate']; ?> </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="NIC_BRNo" class="form-label">NIC/BR No.</label>
                            <input type="text" class="form-control" id="NIC_BRNo" name="NIC_BRNo" value="<?php echo@$NIC_BRNo; ?>" >
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['NIC_BRNo']; ?> </span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echo@$Address; ?>" >
                            <span  style="font-size:12px;" class="text-danger"><?php echo @$error['Address']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="Email" name="Email" value="<?php echo@$Email; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Email']; ?> </span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Telephone" class="form-label">Telephone</label>
                            <input type="tel" class="form-control" id="Telephone" name="Telephone"  maxlength="10" value="<?php echo@$Telephone; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Telephone']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="Mobile" class="form-label">Mobile</label>
                            <input type="tel" class="form-control" id="Mobile" name="Mobile" maxlength="10"  value="<?php echo@$Mobile; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Mobile']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="FaxNo" class="form-label">Fax No.</label>
                            <input type="tel" maxlength="10"  class="form-control" id="FaxNo" name="FaxNo" value="<?php echo@$FaxNo; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['FaxNo']; ?> </span>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="Website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="Website" name="Website" value="<?php echo@$Website; ?>">
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['Website']; ?> </span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="ContactPersonName" class="form-label">Contact Person</label>
                            <input type="text" class="form-control" id="ContactPersonName" name="ContactPersonName" value="<?php echo@$ContactPersonName; ?>" >
                        </div>                        
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="ContactPersonNumber" class="form-label">Number</label>
                            <input type="tel" class="form-control" id="ContactPersonNumber" name="ContactPersonNumber"  maxlength="10" value="<?php echo@$ContactPersonNumber; ?>" >
                            <span style="font-size:12px;" class="text-danger"><?php echo @$error['ContactPersonNumber']; ?> </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <center> <button type="submit" style="background: #778899; color: white; width: 150px" class="btn ashs2">Save</button></center>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include '../footer.php';
    ob_flush();
    ?>    