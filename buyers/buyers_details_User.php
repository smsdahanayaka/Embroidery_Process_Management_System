<?php
include '../header.php';
include '../db_connection.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%;">Buyer Details </h3>    
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">
</div>
<?php
$sql = "SELECT * FROM buyerdetails WHERE UseStstus = 'Active'";
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

<table class="table table-hover table-sm table-bordered table-sortable " id="myTable2">
    <thead >
        <tr  style="background-color:#646a70; color: white; text-align: center; vertical-align: middle;">
            <th id="BuyerIDs" style="font-size: 13px; text-align: center; ">ID</th>            
            <th style="font-size: 13px; text-align: center; ">Name</th>  
            <th style="font-size: 13px; text-align: center; ">Contact Person</th>
            <th style="font-size: 13px; text-align: center; ">Contact Person No.</th>           
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td style="font-size: 12px; font-weight: bold;  vertical-align: middle;"><?php echo $row['BuyerID'] ?></td>                             
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['BuyerName'] ?></td>                 
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['ContactPersonName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['ContactPersonNumber'] ?></td>
                   
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
<div id="dataModal" class="modal fade" style=" margin-top: 50px; width:100%;  "  >
    <di class="modal-dialog row justify-content-md-center main">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Buyer Details</h4>
                <button type="button" class="close " data-dismiss="modal" >&times;</button>
            </div>
            <div class="modal-body" id="employee_detail">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </di>
</div>
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
    function viewBuyer() {
        var internalId = $("#InternalId").val();
        alert(internalId);
    }
</script>