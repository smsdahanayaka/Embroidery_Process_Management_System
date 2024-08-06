<?php
include '../header.php';
include '../db_connection.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Invoices</h3>
    <a href="<?php echo site_url; ?>invoice/create_invoice.php" class="btn btn-sm ashs2" style="background: #778899; color: white; margin-right: 50%;" ><span><i class="fas fa-plus-circle"></i></span></a>
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">  
</div>
<?php
$sql = "SELECT * FROM invoice LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  invoice.BuyerID WHERE RecordStatus = 'Active'";
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
            <th style="font-size: 13px; text-align: center; ">Invoice Id</th>
            <th style="font-size: 13px; text-align: center; ">Invoice Date</th>
            <th style="font-size: 13px; text-align: center; ">Buyer Name</th>
            <th style="font-size: 13px; text-align: center; ">Gross Amount </th>
            <th style="font-size: 13px; text-align: center; ">Discount Rate &nbsp;(%) </th>            
            <th style="font-size: 13px; text-align: center; ">Total Amount</th>            
            <th style="font-size: 13px; text-align: center; ">Remarks</th>            
            <th style="font-size: 13px; ">View</th>
            <th style="font-size: 13px;">Remove</th>


        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['invoiceId'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Date'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['GrossAmount'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['DiscountRate'] ?></td>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['TotalAmount'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td>

                    <td>
                        <form target="_blank" method="post" action="<?php echo site_url; ?>invoice/InvoiceView.php">
                            <input type="hidden" name="invoiceId" value="<?php echo $row['invoiceId']; ?>">                           
                            <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-eye"></i></button>
                        </form>

                    </td>
                    <td>
                        <form  id="remove_form<?php echo $row['InternalId']; ?>" method="post" action="<?php echo site_url; ?>invoice/remove.php">
                            <input type="hidden" name="invoiceId" value="<?php echo $row['invoiceId']; ?>">
                            <input type="hidden" name="BuyerID" value="<?php echo $row['BuyerID']; ?>">
                            <input type="hidden" name="TotalAmount" value="<?php echo $row['TotalAmount']; ?>">
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






