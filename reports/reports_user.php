<?php
include '../header.php';
include '../db_connection.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" >
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Reports</h3>

    

</div>

<style>
    .bttts{
        background: #778899 !important;
    } 
    .bttts:hover{
        background: #323b43 !important;
        border: 2px solid  #323b43 !important;
        color: white !important;
    } 
</style>

<section class="hero">
    <div class="hero-content">            
        <a href="#" hidden id="buttonpop" class="buttonpop bttts" style="width:350px;margin-top: 100px; ">Buyer Details</a><br>
        <a href="#" id="buttonpop2" class="buttonpop bttts" style="width:350px">Order Details</a><br>
        <a href="#" id="buttonpop3" class="buttonpop bttts" style="width:350px">Sample  Details</a><br>
        <a href="#" id="buttonpop4" class="buttonpop bttts" style="width:350px">Quotations  Details</a><br>
        <a href="#" id="buttonpop5" class="buttonpop bttts" style="width:350px">Invoices  Details</a><br>        
        <a href="#" id="buttonpop7" class="buttonpop bttts" style="width:350px">Materials stock  Details</a><br>        
        <a href="#" id="buttonpop9" class="buttonpop bttts" style="width:350px">Good Issue Notes Details</a><br>
        <a href="#" hidden id="buttonpop8" class="buttonpop bttts" style="width:350px">Materials suppliers  Details</a><br>
        <a href="#" hidden id="buttonpop6" class="buttonpop bttts" style="width:350px">Payment  Details</a><br>

    </div>

</section>

<div class="bg-modal" style="margin-left: 0%">

    <div class="modal-contents" style="margin-right: 25%">
        <div class="close">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/buyerReport.php">
            <h3 style="color: black;">Buyer Detail Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="RegisterDateFrom" class="form-label">Register Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="RegisterDateFrom" name="RegisterDateFrom" value="<?php echo@$RegisterDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['RegisterDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="RegisterDateTo" class="form-label">Register Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="RegisterDateTo" name="RegisterDateTo" value="<?php echo@$RegisterDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['RegisterDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>


<!--secont filter-->
<div class="bg-modal2" style="margin-left: 0%">

    <div class="modal-contents2" style="margin-right: 25%">
        <div class="close2">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/orderReport.php">
            <h3 style="color: black;">Order Detail Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom" required>
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo" required>
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="orderDateFrom" class="form-label">Order Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="orderDateFrom" name="orderDateFrom" value="<?php echo@$orderDateFrom; ?>" required>
                        <span class="text-danger"><?php echo @$error['orderDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="OrderDateTo" class="form-label">Order Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="OrderDateTo" name="OrderDateTo" value="<?php echo@$OrderDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['OrderDateTo']; ?> </span>
                    </td>
                </tr>
            </table><table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="OrderStatus" class="form-label">Order Status</label>
                    </td>
                    <td style="padding: 0">

                        <select class="form-select" aria-label="Default select example" name="OrderStatus" id="OrderStatus">
                            <option value="">--Select Status--</option>                    
                            <option value="Ongoing" <?php if (@$OrderStatus == 'Ongoing') { ?>selected<?php } ?> >Ongoing</option>
                            <option value="Finish" <?php if (@$OrderStatus == 'Finish') { ?>selected<?php } ?>>Finish</option>
                            <option value="Delivered" <?php if (@$Title == 'Delivered') { ?>selected<?php } ?>>Delivered</option>
                        </select>
                        <span class="text-danger"><?php echo @$error['Title']; ?> </span>


                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>

<!--third filter sample report-->

<div class="bg-modal3" style="margin-left: 0%">

    <div class="modal-contents3" style="margin-right: 25%">
        <div class="close3">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/sampleReport.php">
            <h3 style="color: black;">Sample Detail Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="SampleDateFrom" class="form-label">Sample Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="SampleDateFrom" name="SampleDateFrom" value="<?php echo@$SampleDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['SampleDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="SampleDateTo" class="form-label">Sample Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="RegisterDateTo" name="SampleDateTo" value="<?php echo@$SampleDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['SampleDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<!--4th filter Quotations report-->
<div class="bg-modal4" style="margin-left: 0%" id="bg-modal4">

    <div class="modal-contents4" style="margin-right: 25%" id="modal-contents4">
        <div class="close4" id="close4">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/quotationReport.php">
            <h3 style="color: black;">Quotation Details Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 180px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 180px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 180px; text-align:left;  ">
                        <label for="QuotationsDateFrom" class="form-label">Quotations Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="QuotationsDateFrom" name="QuotationsDateFrom" value="<?php echo@$QuotationsDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['QuotationsDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 180px; text-align:left; ">
                        <label for="QuotationsDateTo" class="form-label">Quotations Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="QuotationsDateTo" name="QuotationsDateTo" value="<?php echo@$QuotationsDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['QuotationsDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>

<!--5th Report Filter Invoice Details-->
<div class="bg-modal5" style="margin-left: 0%">

    <div class="modal-contents5" style="margin-right: 25%">
        <div class="close5">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/invoiceReport.php">
            <h3 style="color: black;">Invoice Details Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="InvoiceDateFrom" class="form-label">Invoice Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="InvoiceDateFrom" name="InvoiceDateFrom" value="<?php echo@$InvoiceDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['InvoiceDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="InvoiceDateTo" class="form-label">Invoice Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="InvoiceDateTo" name="InvoiceDateTo" value="<?php echo@$InvoiceDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['InvoiceDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<!--6th Report Filter Payment Details-->
<div class="bg-modal6" style="margin-left: 0%">

    <div class="modal-contents6" style="margin-right: 25%">
        <div class="close6">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/paymentRepor.php">
            <h3 style="color: black;">Payment Details Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="BuyerIDFrom" class="form-label">Buyer Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDFrom" id="BuyerIDFrom">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="BuyerIDTo" class="form-label">Buyer Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="BuyerIDTo" id="BuyerIDTo">
                        <option>--Select Buyer ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['BuyerID'] ?>" <?php if ($row['BuyerID'] == @$BuyerID) { ?> selected <?php } ?>> <?php echo $row['BuyerID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="PaymentDateFrom" class="form-label">Payment Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="PaymentDateFrom" name="PaymentDateFrom" value="<?php echo@$PaymentDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['PaymentDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="PaymentDateTo" class="form-label">Payment Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="PaymentDateTo" name="PaymentDateTo" value="<?php echo@$PaymentDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['PaymentDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<!--7th report filter material stocks-->
<div class="bg-modal7" style="margin-left: 0%">

    <div class="modal-contents7" style="margin-right: 25%">
        <div class="close7">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/materialReport.php">
            <h3 style="color: black;">Material Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="MaterialIDFrom" class="form-label">Material Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM materials WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="MaterialIDFrom" id="MaterialIDFrom">
                        <option>--Select Material ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['MaterialID'] ?>" <?php if ($row['MaterialID'] == @$MaterialID) { ?> selected <?php } ?>> <?php echo $row['MaterialID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="MaterialIDTo" class="form-label">Material Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM materials WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="MaterialIDTo" id="MaterialIDTo">
                        <option>--Select Material ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['MaterialID'] ?>" <?php if ($row['MaterialID'] == @$MaterialID) { ?> selected <?php } ?>> <?php echo $row['MaterialID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<!--8th report filter material stocks Suppliers-->
<div class="bg-modal8" style="margin-left: 0%">

    <div class="modal-contents8" style="margin-right: 25%">
        <div class="close8">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/materialsSuppliers.php">
            <h3 style="color: black;">Materials Suppliers Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="MaterialIDFrom" class="form-label">Material Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM materials WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="MaterialIDFrom" id="MaterialIDFrom">
                        <option>--Select Material ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['MaterialID'] ?>" <?php if ($row['MaterialID'] == @$MaterialID) { ?> selected <?php } ?>> <?php echo $row['MaterialID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="MaterialIDTo" class="form-label">Material Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM materials WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="MaterialIDTo" id="MaterialIDTo">
                        <option>--Select Material ID--</option>
                        <?php
                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                ?>                                    
                                <option value=" <?php echo $row['MaterialID'] ?>" <?php if ($row['MaterialID'] == @$MaterialID) { ?> selected <?php } ?>> <?php echo $row['MaterialID'] ?> </option>
                                <?php
                            }
                        }
                        ?>

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="SupplyDateFrom" class="form-label">Supply Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="SupplyDateFrom" name="SupplyDateFrom" value="<?php echo@$SupplyDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['SupplyDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="SupplyDateTo" class="form-label">Supply Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="SupplyDateTo" name="SupplyDateTo" value="<?php echo@$SupplyDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['SupplyDateTo']; ?> </span>
                    </td>
                </tr>
            </table>
            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<!--9th Report Filter GIN Details-->
<div class="bg-modal9" style="margin-left: 0%">

    <div class="modal-contents9" style="margin-right: 25%">
        <div class="close9">+</div>

        <form target="_blank" method="post" action="<?php echo site_url; ?>reports/ginRepot.php">
            <h3 style="color: black;">Good Issue Notes Report Filter</h3>
            <hr>

            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="OrderIDFrom" class="form-label">Order Id From</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM orderdetails WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="OrderIDFrom" id="OrderIDFrom">
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

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="OrderIDTo" class="form-label">Order Id To</label>
                    </td>
                    <td style="padding: 0">
                        <?php
                        $sql = "SELECT * FROM orderdetails WHERE RecordeStatus ='Active' ";
                        $result = $conn->query($sql);
                        ?>

                <center> <select  class="form-select" aria-label="Default select example" name="OrderIDTo" id="OrderIDTo">
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

                    </select></center>
                </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left;  ">
                        <label for="GINDateFrom" class="form-label">GIN Date From</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="GINDateFrom" name="GINDateFrom" value="<?php echo@$GINDateFrom; ?>">
                        <span class="text-danger"><?php echo @$error['GINDateFrom']; ?> </span>
                    </td>
                </tr>
            </table>
            <table style="margin-left: 40px">
                <tr text-align: center;>
                    <td style="width: 160px; text-align:left; ">
                        <label for="GINDateTo" class="form-label">GIN Date To</label>
                    </td>
                    <td style="padding: 0">
                        <input type="date" class="form-control" id="GINDateTo" name="GINDateTo" value="<?php echo@$GINDateTo; ?>">
                        <span class="text-danger"><?php echo @$error['GINDateTo']; ?> </span>
                    </td>
                </tr>
            </table>

            <button class="buttonpop" type="submit">View Report</button>
            <input type="hidden" name="fiestname" value="<?php echo $fiestname; ?>">
            <input type="hidden" name="lastName" value="<?php echo $lastName; ?>">
        </form>

    </div>
</div>
<link href="<?php echo site_url; ?>/css/popup.css" rel="stylesheet" type="text/css"/>
<?php
include '../footer.php';
?>

<script>
    document.getElementById('buttonpop').addEventListener("click", function () {
        document.querySelector('.bg-modal').style.display = "flex";
    });

    document.querySelector('.close').addEventListener("click", function () {
        document.querySelector('.bg-modal').style.display = "none";
    });

    document.getElementById('buttonpop2').addEventListener("click", function () {
        document.querySelector('.bg-modal2').style.display = "flex";
    });

    document.querySelector('.close2').addEventListener("click", function () {
        document.querySelector('.bg-modal2').style.display = "none";
    });

    document.getElementById('buttonpop3').addEventListener("click", function () {
        document.querySelector('.bg-modal3').style.display = "flex";
    });

    document.querySelector('.close3').addEventListener("click", function () {
        document.querySelector('.bg-modal3').style.display = "none";
    });

    document.getElementById('buttonpop4').addEventListener("click", function () {
        document.querySelector('.bg-modal4').style.display = "flex";
    });

    document.querySelector('.close4').addEventListener("click", function () {
        document.querySelector('.bg-modal4').style.display = "none";
    });

    document.getElementById('buttonpop5').addEventListener("click", function () {
        document.querySelector('.bg-modal5').style.display = "flex";
    });

    document.querySelector('.close5').addEventListener("click", function () {
        document.querySelector('.bg-modal5').style.display = "none";
    });

    document.getElementById('buttonpop6').addEventListener("click", function () {
        document.querySelector('.bg-modal6').style.display = "flex";
    });

    document.querySelector('.close6').addEventListener("click", function () {
        document.querySelector('.bg-modal6').style.display = "none";
    });

    document.getElementById('buttonpop7').addEventListener("click", function () {
        document.querySelector('.bg-modal7').style.display = "flex";
    });

    document.querySelector('.close7').addEventListener("click", function () {
        document.querySelector('.bg-modal7').style.display = "none";
    });
    document.getElementById('buttonpop8').addEventListener("click", function () {
        document.querySelector('.bg-modal8').style.display = "flex";
    });

    document.querySelector('.close8').addEventListener("click", function () {
        document.querySelector('.bg-modal8').style.display = "none";
    });

    document.getElementById('buttonpop9').addEventListener("click", function () {
        document.querySelector('.bg-modal9').style.display = "flex";
    });

    document.querySelector('.close9').addEventListener("click", function () {
        document.querySelector('.bg-modal9').style.display = "none";
    });
</script>
