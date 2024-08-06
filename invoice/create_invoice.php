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

    $sql8 = "SELECT * FROM payment_details WHERE BuyerID = '$BuyerID'";
    $result8 = $conn->query($sql8);
    $row = $result8->fetch_assoc();
    @$Invoice_total = $row['Invoice_total'];




    $error = array();

    $Date = dataClean($Date);
    if (empty($Date)) {
        $error['Date'] = "Invoice Date is not select";
    }

    if (empty($error)) {
        $RecordStatus = "Active";
        $Remarks = " ";
        $Status = "null";
        $sql = "INSERT INTO invoice(invoiceId,Date,BuyerID,GrossAmount,LastBalance,DiscountRate,TotalAmount,Remarks,Status,RecordStatus) VALUES('$invoiceId','$Date','$BuyerID','$GrossAmount','$LastBalance','$DiscountRate','$TotalAmount','$Remarks','$Status','$RecordStatus')";
        $conn->query($sql);

        $Invoice_total = $Invoice_total + $TotalAmount;
        $sql9 = "UPDATE payment_details SET Invoice_total ='$Invoice_total' WHERE BuyerID = '$BuyerID'";
        $conn->query($sql9);



        for ($a = 0; $a < count($_POST["OrderId"]); $a++) {
            @$InternalId = $_POST["OrderId"][$a];
            $sql4 = "SELECT * FROM orderdetails WHERE InternalId = '$InternalId' ";

            $result = $conn->query($sql4);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                @$OrderId = $row['OrderId'];
                @$Artwork = $row['Artwork'];
            }
            $RecordeStatus2 = "Active";
            $sq3 = "INSERT INTO invoice_items (invoiceId,Date,BuyerID,OrderId,Artwork,Qty,Unite_Price,Amount,RecordeStatus)VALUES('$invoiceId','$Date','$BuyerID','$OrderId','$Artwork','" . $_POST["Qty"][$a] . "','" . $_POST["Unite_Price"][$a] . "','" . $_POST["Amount"][$a] . "','$RecordeStatus2')"; //           
            $conn->query($sq3);

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);

            $notifaction = "New Invoice Created";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $activityDoneBy = "By " . $fiestname . " " . $lastName;
            $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
            $conn->query($sql7);
        }
        header("Location:invoice.php");
    }
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
        <h3 class="h3" style="color: #4B4847; margin-left: 2%">Invoice | Create</h3>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="invoiceId" class="form-label">Invoice ID</label>
                    <input type="text" class="form-control" id="invoiceId" name="invoiceId" value="<?php echo idGenerator('INV', 'invoice', 'invoiceId', 'invoiceId'); ?>" readonly style="width: 130px;" >
                    <span class="text-danger"><?php echo @$error['invoiceId']; ?> </span>
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
                        <option>--Select Buyer ID--</option>
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
                    <label for="Date" class="form-label">Invoice Date</label>
                    <input type="date" class="form-control" id="Date" name="Date" value="<?php echo@$Date; ?>">
                    <span style="font-size:12px;" class="text-danger"><?php echo @$error['Date']; ?> </span>
                </div>
            </div>
        </div>

        <a href="<?php echo site_url; ?>invoice/invoice.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
    </div>
    <table class="table table-bordered" id="invoic_item">
        <thead>
            <tr >
                <th style="width:15%; vertical-align: middle; ">Order ID</th>
                <th style="vertical-align: middle; text-align: center;" >Artwork</th>                
                <th style="width:18%; vertical-align: middle; text-align: center; ">Qty </th>
                <th style="width:18%; vertical-align: middle; text-align: center;">Unite Price</th>
                <th style="width:18%; vertical-align: middle; text-align: center;">Amount</th>
                <th style="width:12%; vertical-align: middle;"><button type="button" id="add_row" class="btn btn-default" onclick="getOrderIds(); incRowID()" hidden="hidden" ><span  fontSize="100px" ><i class="fas fa-plus-circle"></i> Add Row</span></button></th>
            </tr>
        </thead>
        <tbody>

        </tbody>


    </table>

    <table  class="table ">
        <tr>
            <td style="width:70%">Gross  Amount</td>
            <td style="width:18%"><input style="vertical-align: middle; text-align: right;" type="number" id="GrossAmount" name="GrossAmount" class="form-control" readonly></td>
            <td style="width:12%"></td>
        </tr>
        <tr>
            <td style="width:70%">Last month Balance Payment</td>
            <td style="width:18%"><input style="vertical-align: middle; text-align: right;" type="text" id="LastBalance" name="LastBalance" class="form-control" onkeyup="subAmount()" readonly></td>
            <td style="width:12%"></td>
        </tr>
        <tr>
            <td style="width:70%">Discount&nbsp;(%)</td>
            <td style="width:18%"><input style="vertical-align: middle; text-align: right;" type="number" id="DiscountRate" name="DiscountRate" class="form-control" onkeyup="subAmount()" onchange="subAmount()"></td>
            <td style="width:12%"></td>
        </tr>
        <tr>
            <td style="width:70%">Total  Amount</td>
            <td style="width:18%"><input style="vertical-align: middle; text-align: right;" type="number" id="TotalAmount"  name="TotalAmount"  class="form-control" readonly></td>
            <td style="width:12%"></td>
        </tr>
    </table>

    <div class="card-footer">
        <center><button  style="background: #778899; color: white;" id="createInvoice" type="submit" disabled="disabled" class="btn ashs2">Create Invoice</button></center>
    </div>

</form>
<?php
include '../footer.php';
ob_flush();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#add_row").off('click').on('click', function () { // kalin click wela thiyana siyalu event ain wela dan me function eka start karannna
            var table = $("#invoic_item");//sampurana table ekama object ekak widihata veriyabal ekakata gannawa             
            var count_table_tbody_tr = $("#invoic_item tbody tr").length;//rows kiyak thiyanawada kiyala count karanawa
            var row_id = count_table_tbody_tr + 1;
            var html = '<tr id="row_' + row_id + '">';
            html += '<td>' +
<?php
$sql = "SELECT * FROM orderdetails";
$result = $conn->query($sql);
?>
            '<select class="form-control" name="OrderId[]" data-row-id="row_' + row_id + '" id="order_' + row_id + '" onchange="getOrderData(' + row_id + ')" >' +
                    '<option value="">--Select Order ID--</option>' +
                    '</select>' +
                    '</td>';
            html += '<td align="center" style="vertical-align: middle; text-align: center;" ><img name="Artwork[]" class="form-control" id="Artwork_' + row_id + '" style="width:100px " src=""></td>';
            html += '<td style="vertical-align: middle; text-align: center;" ><input style="text-align:center" type="number" name="Qty[]" class="form-control" id="Qty_' + row_id + '"></td>';
            html += '<td style="vertical-align: middle; text-align: right;" ><input type="number" style="text-align:right" name="Unite_Price[]" class="form-control" id="UnitPrice_' + row_id + '" onkeyup="getTotal(' + row_id + ')" onchange="getTotal(' + row_id + ')" ></td>';
            html += '<td style="vertical-align: middle; text-align: right;"><input style="vertical-align: middle; text-align: right;" type="number" name="Amount[]" class="form-control" id="amount_' + row_id + '" readonly></td>';
            html += '<td style="vertical-align: middle; text-align: right;"  ><button style="vertical-align: middle; text-align: right;" type="button" class="btn btn-default" onclick="removeRow(' + row_id + ')" > <span><i class="fas fa-minus-circle"></i> </span></button></td>';
            html += '</tr>';

            if (count_table_tbody_tr >= 1) {
                $("#invoic_item tbody tr:last").after(html); // anthima row ekata passe html eke thiyana eka danna
            } else {
                $("#invoic_item tbody").html(html);
            }


        })
    })
    function removeRow(tr_id)
    {
        $("#invoic_item tbody tr#row_" + tr_id).remove();
        subAmount();
    }
    function getOrderData(row_id) {
        var InternalId = ($("#order_" + row_id).val());
        $.ajax({
            url: 'getOrderData.php',
            type: 'post',
            data: {InternalId: InternalId},
            dataType: 'json',

            success: function (response) {
                alert(response);
                $("#Qty_" + row_id).val(response.Qty);
                var Artwork = response.Artwork;
                $("#Artwork_" + row_id).attr("src", Artwork);
                $("#UnitPrice_" + row_id).val(1.00);

                //qty convert to number format
                var amount = Number(response.Qty) * 1;
                amount = amount.toFixed(2);
                $("#amount_" + row_id).val(amount);
                subAmount();
            }//success
        });//ajax function to fatch the Order Data
    }
    function subAmount() {
        var tableProductLength = $("#invoic_item tbody tr").length; // counting the table rows using J query
        var totalSubAmount = 0;
        for (x = 0; x < tableProductLength; x++) {
            var tr = $("#invoic_item tbody tr")[x];
            var count = $(tr).attr('id');
            count = count.substring(4);
//            alert(count);
            totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
        }
        totalSubAmount = totalSubAmount.toFixed(2);
        $("#GrossAmount").val(totalSubAmount);

        var totalAmount = Number(totalSubAmount);
        totalAmount = totalAmount.toFixed(2);

        var discount = $("#DiscountRate").val();
        discount = (Number(discount) * Number(totalAmount)) / 100;

        var balance = $("#LastBalance").val();

        var grandTotal = Number(totalAmount) - Number(discount);

        var grandTotal = Number(balance) + Number(grandTotal);


        grandTotal = grandTotal.toFixed(2);
        $("#TotalAmount").val(grandTotal);
    }

    function getTotal(row_id) {
        var total = Number($("#Qty_" + row_id).val()) * Number($("#UnitPrice_" + row_id).val());
        total = total.toFixed(2);
        $("#amount_" + row_id).val(total);
        subAmount();
        $("#createInvoice").removeAttr("disabled");
    }
    function getOrderIds() {
        var BuyerID = $("#BuyerID").val();
        var row_id = $('#invoic_item tr').length;
        $.ajax({
            url: 'getOrderIdes.php',
            type: 'post',
            data: {BuyerID: BuyerID},
            dataType: 'json',
            success: function (response) {
                var orderID = document.getElementById('order_' + row_id);
                for (let i in response) {
                    orderID.innerHTML = orderID.innerHTML +
                            '<option value="' + response[i].InternalId + '">' + response[i].OrderId + '</option>';
                }

                $("#LastBalance").val(response.BalancePayment);
            }//success
        });//ajax function to fatch the Order Data
    }
    function dropDownChange() {

        $('#BuyerID option:not(:selected)').prop('disabled', true);
        $("#add_row").removeAttr("hidden");
        $("#editBtn").removeAttr("hidden");

    }
    
</script>