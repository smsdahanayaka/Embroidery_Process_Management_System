<?php
include '../header.php';
include '../db_connection.php';
?>
<style>
        /* Style for the image container */
   .image-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);     
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
            border: 1px solid #ccc;
            z-index: 9999; /* Ensure it's above other elements */
            display: none; /* Initially hidden */
        }

        /* Style for the image */
        .image-container img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Order Details </h3>
    <a href="<?php echo site_url; ?>orders/add_order.php" class="btn btn-sm ashs2" style="background: #778899; color: white; margin-right: 48%;" ><span><i class="fas fa-plus-circle"></i></span></a>
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">
</div>

<?php
$sql = "SELECT * FROM orderdetails WHERE RecordeStatus = 'Active'";
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
            <th style="font-size: 13px; text-align: center; ">ID</th>
            <th style="font-size: 13px; text-align: center; ">Date</th>
            <th style="font-size: 13px; text-align: center; ">Buyer ID</th>
            <th style="font-size: 13px; text-align: center; ">Description</th>          
            <th style="font-size: 13px; text-align: center; ">Style No</th>
            <th style="font-size: 13px; text-align: center; ">Bundle No</th>
            <th style="font-size: 13px; text-align: center; ">Qty</th>
            <th style="font-size: 13px; text-align: center; ">Order material</th>
            <th style="font-size: 13px; text-align: center; ">Artwork</th>                   
            <th style="font-size: 13px; text-align: center; ">Remarks</th>
            <th style="font-size: 13px; text-align: center; ">Status</th>
            <th style="font-size: 13px;  ">Edit</th>
            <th style="font-size: 13px;  ">Remove</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                        <tr>
                            <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['OrderId'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['OrderDate'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerID'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['OrderDescription'] ?></td>                   
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['StyleNo'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BundleNumber'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Qty'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Ordermaterial'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><div class="image-link"> <a href="<?php echo $row['Artwork'] ?>" target="_blank"> <img style="width:50px" src="<?php echo $row['Artwork'] ?>" alt="Artwork"> </a> <div class="image-container"> <img src="<?php echo $row['Artwork'] ?>" alt="Artwork"> </div> </div> </td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Remarks'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Status'] ?></td>                  
                            <td>
                                <form method="post" action="<?php echo site_url; ?>orders/edit.php">
                                    <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                                    <button  style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-edit"></i></button>
                                </form>

                            </td>
                            <td>
                                <form  id="remove_form<?php echo $row['InternalId']; ?>" method="post" action="<?php echo site_url; ?>orders/remove.php">
                                    <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                                    <button  style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="button" onclick="removeRecord('remove_form<?php echo $row['InternalId']; ?>')"><i class="fas fa-eraser"></i></button>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all image links
        var imageLinks = document.querySelectorAll(".image-link");

        // Add mouseover event listener to each image link
        imageLinks.forEach(function(link) {
            link.addEventListener("mouseover", function() {
                // Show the image container on mouseover
                this.querySelector(".image-container").style.display = "block";
            });

            // Add mouseout event listener to each image link
            link.addEventListener("mouseout", function() {
                // Hide the image container on mouseout
                this.querySelector(".image-container").style.display = "none";
            });
        });
    });
</script>
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
<?php
include '../footer.php';
?> 