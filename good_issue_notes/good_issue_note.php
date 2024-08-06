<?php
include '../header.php';
include '../db_connection.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%; ">Good Issue Note</h3>    
    <a href="<?php echo site_url; ?>good_issue_notes/add_good_issue_note.php" class="btn btn-sm ashs2" style="background: #778899; color: white; margin-right: 45%;" ><span><i class="fas fa-plus-circle"></i></span></a>
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">
</div>
<?php
//$sql = "SELECT * FROM good_issue_note WHERE RecordeStatus = 'Active'";
//$sql = "SELECT * FROM FROM good_issue_note  LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  samples.BuyerID WHERE RecordeStatus = 'Active'";
$sql = " SELECT
good_issue_note.InternalId,
good_issue_note.GIR_Number,
good_issue_note.Date,
good_issue_note.OrderId,
good_issue_note.VehicleNo,
good_issue_note.DeliveryTo,
good_issue_note.Discription,
good_issue_note.Remarks,
good_issue_note.RecordeStatus,
good_issue_note.Status, 
buyerdetails.BuyerName
FROM good_issue_note
JOIN orderdetails
ON orderdetails.OrderId = good_issue_note.OrderId
JOIN buyerdetails
ON buyerdetails.BuyerID = orderdetails.BuyerID 
WHERE good_issue_note.RecordeStatus = 'Active'";
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
    <thead  >    
        <tr style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;" >
            <th style="font-size: 13px; text-align: center; ">GIR No.</th>
            <th style="font-size: 13px; text-align: center; ">Date</th>
            <th style="font-size: 13px; text-align: center; ">Order Id</th>
            <th style="font-size: 13px; text-align: center; ">Buyer</th>
            <th style="font-size: 13px; text-align: center; ">Vehicle No</th>
            <th style="font-size: 13px; text-align: center; ">Delivery To</th>
            <th style="font-size: 13px; text-align: center; ">Description</th>
            <th style="font-size: 13px; text-align: center; ">Remarks</th>
            <th style="font-size: 13px; text-align: center; ">Status</th>  
            <th style="font-size: 13px; text-align: center; ">Edit</th>
            <th style="font-size: 13px; text-align: center; ">Remove</th>
        </tr>
    </thead>
    <tbody id="myTable" >
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['GIR_Number'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Date'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['OrderId'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['VehicleNo'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['DeliveryTo'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Discription'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Status'] ?></td>
                    <td>
                        <form method="post" action="<?php echo site_url; ?>good_issue_notes/update_good_issue_note.php">
                            <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                            <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-edit"></i></button>
                        </form>
                    </td>
                    <td>
                        <form  id="remove_form<?php echo $row['InternalId']; ?>" method="post" action="<?php echo site_url; ?>good_issue_notes/remove_good_issue_note.php">
                            <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                            <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="button" onclick="removeRecord('remove_form<?php echo $row['InternalId']; ?>')"><i class="fas fa-eraser"></i></button>
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