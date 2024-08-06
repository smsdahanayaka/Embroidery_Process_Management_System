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
        $error['Date'] = "Invoice Date is not select";
    }
    if (empty($BuyerID)) {
        $error['BuyerID'] = "Please Select a Buyer Id";
    }
    if (empty($error)) {
        $RecordStatus = "Active";
        $sql = "INSERT INTO quotations(quotationId,BuyerID,Date,GrossAmount,DiscountRate,NetAmount,RecordStstus) VALUES('$quotationId','$BuyerID','$Date','$glossAmount','$discount','$netAmount','$RecordStatus')";
        $conn->query($sql);


        $nDiscription = count($discription);
        for ($i = 0; $i < $nDiscription; $i++) {
            $RecordStatus = "Active";
            $sql = "INSERT INTO quotations_items (quotationId,BuyerID,Date,description,qty,rate,amount,RecordStstus) VALUES('$quotationId','$BuyerID','$Date','" . $discription[$i] . "','" . $qty[$i] . "', '" . $rate[$i] . "', '" . $amount[$i] . "', '$RecordStatus')";
            $conn->query($sql);

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);

            $notifaction = "New Quotation Created";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $activityDoneBy = "By " . $fiestname . " " . $lastName;
            $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$quotationId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
            $conn->query($sql7);
        }
        // header("Location:invoice.php");
    }
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
        <h3 class="h3" style="color: #4B4847; margin-left: 2%">Quotations | Create</h3>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="quotationId" class="form-label">Quotation ID</label>
                    <input type="text" class="form-control" id="quotationId" name="quotationId" value="<?php echo idGenerator('QUO', 'quotations', 'quotationId', 'quotationId'); ?>" readonly style="width: 130px;" >
                    <span class="text-danger"><?php echo @$error['quotationId']; ?> </span>
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
                    <select class="form-select" aria-label="Default select example" name="BuyerID" id="BuyerID"  onclick="getOrderIds()" onchange="dropDownChange()">
                        <option value="">--Select Buyer ID--</option>
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
                    <label for="Date" class="form-label">Quotation Date</label>
                    <input type="date" class="form-control" id="Date" name="Date" value="<?php echo@$Date; ?>">
                    <span style="font-size:12px;" class="text-danger"><?php echo @$error['Date']; ?> </span>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url; ?>quotations/quotations.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
<!--    <table class="table table-bordered" id="invoic_item">-->

    <table class="table table-bordered" id="order_item">
        <thead>
            <tr>
                <th style="width:50%">Description</th>
                <th style="width:10%;text-align:center;">Qty</th>
                <th style="width:10%; text-align:center">Rate&nbsp;(LKR)</th>
                <th style="width:20%; text-align:center">Amount&nbsp;(LKR)</th>
                <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><span><i class="fas fa-plus-circle"></i></span></button></th>
            </tr>
        </thead>
        <tbody>
            <tr id="row_1">
                <td>
                    <input  oninvalid="this.setCustomValidity('Enter Description Here')"  oninput="this.setCustomValidity('')"required type="text"  class="form-control" id="discription_1" name="discription[]">            
                </td>

                <td>
                    <input oninvalid="this.setCustomValidity('Enter Qty Here')"  oninput="this.setCustomValidity('')" required style="text-align:center" type="number" onkeyup="getTotal('1')" class="form-control" id="qty_1" name="qty[]">            
                </td>
                <td>
                    <input required oninvalid="this.setCustomValidity('Enter Rate Here')"  oninput="this.setCustomValidity('')" style="text-align:right" type="number" onkeyup="getTotal('1')" class="form-control" id="rate_1" name="rate[]">         
                </td>
                <td>
                    <input readonly required style="text-align:right" type="number" class="form-control" id="amount_1" name="amount[]">         
                </td>
                <td>
        <center> <button type="button" style="vertical-align: middle;" class="btn btn-default" onclick="removeRow('1')"> <span><i class="fas fa-minus-circle"></i></span></button></center>

        </td>       
        </tbody>
    </table>
    <table  class="table  table-striped table-bordered">
        <tr>
            <td style="width:70%; ">Gross  Amount (LKR)</td>
            <td style="width:20%"><input style="text-align:right" type="number" data-politespace data-grouplength="3,3,4" id="glossAmount" name="glossAmount" readonly class="form-control""></td>
            <td style="width:10%"></td>
        </tr>
        <tr>
            <td style="width:70%">Discount  Rate(%)</td>
            <td style="width:20%"><input type="number" style="text-align:right" id="discount" name="discount" class="form-control"" onkeyup="subAmount()"></td>
            <td style="width:10%"></td>
        </tr>
        <tr>
            <td style="width:70%">Net  Amount(LKR)</td>
            <td style="width:20%"><input readonly type="number" style="text-align:right" id="netAmount"  name="netAmount" class="form-control""></td>
            <td style="width:10%"></td>
        </tr>
    </table>

    <center><button style="background: #778899; color: white;" type="submit" class="btn ashs2">Create Quotation</button></center>

</form>
<?php
include '../footer.php';
ob_flush();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#add_row").off('click').on('click', function () {

            var table = $("#order_item");
            var count_table_tbody_tr = $("#order_item tbody tr").length;
            var row_id = count_table_tbody_tr + 1;

            var html = '<tr id="row_' + row_id + '">';

            html += '<td> <input required type="text" name="discription[]"  class="form-control"  id="discription_' + row_id + '"></td>';
            html += '<td> <input  required type="number" style="text-align:center" name="qty[]" onkeyup="getTotal(' + row_id + ')" class="form-control"  id="qty_' + row_id + '"></td>';
            html += '<td> <input required type="number" style="text-align:right" name="rate[]" onkeyup="getTotal(' + row_id + ')" class="form-control" id="rate_' + row_id + '"></td>';
            html += '<td> <input readonly required  type="number" style="text-align:right" name="amount[]" class="form-control" id="amount_' + row_id + '"></td>';
            html += '<td><button style="vertical-align: middle;" type="button" class="btn btn-default" onclick="removeRow(' + row_id + ')"  ><span><i class="fas fa-minus-circle"></i></span></button> </td>';
            html += '</tr>';

            if (count_table_tbody_tr >= 1) {
                $("#order_item tbody tr:last").after(html);
            } else {
                $("#order_item tbody").html(html);
            }
        })

    })
    function removeRow(tr_id)
    {
        $("#order_item tbody tr#row_" + tr_id).remove();
        subAmount();
    }




    function subAmount() {
        var tableProductLength = $("#order_item tbody tr").length; // counting the table rows using J query
        var totalSubAmount = 0;

        for (x = 0; x < tableProductLength; x++) {
            var tr = $("#order_item tbody tr")[x];
            var count = $(tr).attr('id');
            count = count.substring(4);
//            alert(count);
            totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());

        }
        totalSubAmount = totalSubAmount.toFixed(2);
//        alert(totalSubAmount);
        $("#glossAmount").val(totalSubAmount);

        var totalAmount = Number(totalSubAmount);
        totalAmount = totalAmount.toFixed(2);

        var discount = $("#discount").val();

        discount = (Number(discount) * Number(totalAmount)) / 100;

        var grandTotal = Number(totalAmount) - Number(discount);



        grandTotal = grandTotal.toFixed(2);
        $("#netAmount").val(grandTotal);
    }

    function getTotal(row_id) {

        var total = Number($("#rate_" + row_id).val()) * Number($("#qty_" + row_id).val());
        total = total.toFixed(2);
        $("#amount_" + row_id).val(total);
        subAmount();
    }

</script>    