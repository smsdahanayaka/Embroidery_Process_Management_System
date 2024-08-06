<?php
ob_start();
include '../header.php';
include '../db_connection.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>
   <style>
        /* Style for the image container */
        .image-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);      
            background-color: #fff;
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
    <h3 class="h3" style="color: #4B4847; margin-left: 2%;">Sample Details</h3>    

    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">
</div>
<!--New Sample Insert Start here-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        extract($_POST);
        $error = array();

        if (empty($Date)) {
            $error['Date'] = "The Date should not be blank!";
        }
        if (empty($BuyerID)) {
            $error['BuyerID'] = "Please Select a Buyer Id";
        }
        $SampleDescription = dataClean($SampleDescription);
        if (empty($SampleDescription)) {
            $error['SampleDescription'] = "Please Enter Description about the sample";
        }
        if (empty($error)) {
            $target_dir = "../sample_images/";
            $target_file = $target_dir . rand() . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
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

            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "eps" && $imageFileType != "svg") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = htmlspecialchars($target_file);
                    $OrderId = "Not yet issue";
                    $RecordeStatus = "Active";
                    $BuyerID = str_replace(' ', '', $BuyerID);
                    $sql = "INSERT INTO samples(SampleId,Date,OrderId,BuyerID,SampleDescription,image,RecordeStatus) VALUES('$SampleId','$Date','$OrderId','$BuyerID','$SampleDescription','$image','$RecordeStatus')";
                    $conn->query($sql);

                    $fiestname = str_replace(' ', '', $fiestname);
                    $lastName = str_replace(' ', '', $lastName);

                    $notifaction = "New Sample added";
                    $notifactionId = "0";
                    $date = date("Y-m-d h:i:sa");
                    date_default_timezone_set("Asia/Colombo");
                    $time = date("h:i:sa");
                    $activityDoneBy = "By " . $fiestname . " " . $lastName;
                    $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
                    $conn->query($sql7);

                    $SampleId = $Date = $BuyerID = $SampleDescription = $RecordeStatus = null;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            header("Location:sample_details.php");
        }
    }
    ?>
    <div >
        <div >
        </div>
        <form method="post"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="SampleId" class="form-label">New Sample Id</label>
                                <input type="text" class="form-control" id="SampleId" name="SampleId" style="width:130px"  value="<?php echo idGenerator('SAM', 'samples', 'SampleId', 'SampleId'); ?>" readonly>
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['SampleId']; ?> </span>
                            </div>   
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="Date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="Date" style="width:170px; text-transform:capitalize;" name="Date" value="<?php echo@$Date; ?>">
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['Date']; ?> </span>
                            </div>
                        </div>  
                        <div class="col">
                            <div class="mb-3">
                                <?php
                                $sql = "SELECT * FROM buyerdetails WHERE UseStstus ='Active' ";
                                $result = $conn->query($sql);
                                ?>
                                <label for="BuyerID" class="form-label">Buyer ID</label>
                                <select class="form-select" aria-label="Default select example" name="BuyerID" id="BuyerID">
                                    <option value="">--Select Buyer ID--</option>
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
                                <label for="SampleDescription" class="form-label">Sample Description</label>
                                <textarea class="form-control" id="SampleDescription" name="SampleDescription" value="<?php echo@$SampleDescription; ?>" rows="1" cols="70"><?php echo@$SampleDescription; ?></textarea>
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['SampleDescription']; ?> </span>
                            </div>
                        </div> 
                        <div class="col">
                            <div class="mb-3">
                                <label for="image" class="form-label">Sample image</label>
                                <input type="file" class="form-control" id="image" name="image" value="<?php echo@$image; ?>"/>                                
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['image']; ?> </span>
                            </div>
                        </div> 
                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
                                <button style="background: #778899; color: white;" type="submit" class="btn btn blues ashs2" ><i class="fas fa-save"></i></button>
                                <button style="background: #778899; color: white;" type="reset" class="btn btn blues ashs2"><i class="fas fa-undo-alt"></i></button>
                            </div> 
                        </div>                                            
                    </div>                          
                </div>
            </div>
        </form>
    </div>
</div>
<!--New Sample Insert End here-->
<?php
 
$sql = "SELECT * FROM samples LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  samples.BuyerID WHERE RecordeStatus = 'Active'";
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
<table class="table table-hover table-sm table-bordered table-sortable" id="myTable2">
    <thead style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;">
        <tr>
            <th style="font-size: 13px; text-align: center; ">Sample Id </th>
            <th style="font-size: 13px; text-align: center; ">Date</th>            
            <th style="font-size: 13px; text-align: center; ">Buyer ID</th>
            <th style="font-size: 13px; text-align: center; ">Buyer Name</th>
            <th style="font-size: 13px; text-align: center; ">Order Id</th>
            <th style="font-size: 13px; text-align: center; ">Description</th>
            <th style="font-size: 13px; text-align: center; ">Sample image</th>
            <th style="font-size: 13px; text-align: center; ">Edit</th>
            <th style="font-size: 13px; text-align: center; ">Remove</th>

        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td style="font-size: 12px; font-weight: bold;  vertical-align: middle; text-align: center;"><?php echo $row['SampleId'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Date'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerID'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['BuyerName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['OrderId'] ?></td>                    
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['SampleDescription'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><div class="image-link">
                                                    <a href="<?php echo $row['image'] ?>" target="_blank">
                                                <img style="width:50px" src="<?php echo $row['image'] ?>" alt="Artwork">
                                                </a>
                                                    <div class="image-container">
                                                        <img src="<?php echo $row['image'] ?>" alt="Artwork">
                                                    </div>
                                                </div>
                                                 </td> 
                    <td align="center">
                                <form method="post" action="<?php echo site_url; ?>sample_details/sample_details_Update.php">
                                    <input type="hidden" name="InternalIdS" value="<?php echo $row['InternalIdS']; ?>">
                                    <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-edit"></i></button>                              
                                </form>                                           
                            </td>
                            <td style="margin-left: 30px ">
                                <form  id="remove_form<?php echo $row['InternalIdS']; ?>" method="post" action="<?php echo site_url; ?>sample_details/remove.php">
                                    <input type="hidden" name="InternalIdS" value="<?php echo $row['InternalIdS']; ?>">
                                    <button  style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="button" onclick="removeRecord('remove_form<?php echo $row['InternalIdS']; ?>')"><i class="fas fa-eraser"></i></button>
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
<?php
include '../footer.php';
ob_flush();
?> 