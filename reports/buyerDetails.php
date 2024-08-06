<?php
include '../header.php';
include '../db_connection.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Buyer Details</h3>
    <a href="<?php echo site_url; ?>dashboard.php" class="btn"style="background: #297F87; color: white;" ><span><i class="fas fa-tachometer-alt"></i></span> </a>
</div>
<!--report detail filter start here-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <div >    
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                      
                        <div class="col">
                            <div class="mb-3">
                                <label for="RegisterFromDate" class="form-label">Register From</label>
                                <input type="date" class="form-control" id="RegisterFromDate" style="width:220px; text-transform:capitalize;" name="RegisterFromDate" value="<?php echo@$RegisterFromDate; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['RegisterFromDate']; ?> </span>
                            </div> 
                        </div>
                            <div class="col">
                            <div class="mb-3">
                                <label for="RegisterToDate" class="form-label">Register To</label>
                                <input type="date" class="form-control" id="RegisterToDate" style="width:220px; text-transform:capitalize;" name="RegisterToDate" value="<?php echo@$RegisterToDate; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['RegisterToDate']; ?> </span>
                            </div> 
                        </div>
                        
                        <div class="col">
                            <div class="mb-3">
                                <label for="UseStstus" class="form-label">Buyer Status</label>
                                <select class="form-select" aria-label="Default select example" name="UseStstus" id="UseStstus">
                                    <option value="">--Select Status--</option>
                                    <option value="Active" <?php if (@$UseStstus == 'Active') { ?>selected<?php } ?>>Active</option>
                                    <option value="Inactive" <?php if (@$UseStstus == 'Inactive') { ?>selected<?php } ?>>Inactive</option>                                   
                                </select>
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['UseStstus']; ?> </span>
                            </div>
                        </div>                     
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
                                <button style="background: #1CC5DC; color: white;" type="submit" class="btn " ><i class="fas fa-search"></i></button>
                                <button style="background: #1CC5DC; color: white;" type="reset" class="btn "><i class="fas fa-undo-alt"></i></button>
                            </div> 
                        </div>                                            
                    </div>                          
                </div>
            </div>      
    </div>

</div>
<!--report data filter end here-->

<table class="table table-hover table-sm table-bordered table-sortable " >
    <thead >
        <tr  style="background-color:#646a70; color: white; text-align: center; vertical-align: middle;">
            <th id="BuyerIDs" style="font-size: 13px; text-align: center; ">ID</th>           
            <th style="font-size: 13px; text-align: center; ">Name</th>
            <th style="font-size: 13px; text-align: center; ">NIC/BRNo</th>
            <th style="font-size: 13px; text-align: center; ">Address</th>
            <th style="font-size: 13px; text-align: center; ">Email</th>           
            <th style="font-size: 13px; text-align: center; ">Mobile</th>           
            <th style="font-size: 13px; text-align: center; ">Reg. Date</th>
           
        </tr>
    </thead>
   <tbody id="myTable">
        <?php
        if (isset($_POST['submit'])) {
            
            
            
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['BuyerID'] ?></td>                          
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['NIC_BRNo'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['Address'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['Email'] ?></td>                    
                    <td style="font-size: 12px;  vertical-align: middle;"><?php echo $row['Mobile'] ?></td>           
                   
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

</form>



<?php
include '../footer.php';
?> 