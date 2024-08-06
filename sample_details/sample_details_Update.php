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
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Sample Details | Update</h3>    
    <a href="<?php echo site_url; ?>sample_details/sample_details.php" class="btn ashs2"style="background: #778899; color: white;" ><span><i class="fas fa-arrow-alt-circle-left"></i></span></a>
</div>
<!--New Sample Insert Start here-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <?php
    extract($_POST);
    //echo $InternalId;
    $error = array();
    if ($_SERVER['REQUEST_METHOD'] == "POST" && @$operate == "update") {

        if (empty ($Date)) {
            $error['Date'] = "The Date should not be blank...!";
        }
        $OrderId = dataClean($OrderId);
        if (empty ($OrderId)) {
            $error['OrderId'] = "Order ID field is blank..";
        }
        $BuyerID = dataClean($BuyerID);
        if (empty ($BuyerID)) {
            $error['BuyerID'] = "Please Enter the Buyer Id";
        }
        $SampleDescription = dataClean($SampleDescription);
        if (empty ($SampleDescription)) {
            $error['SampleDescription'] = "Please Enter Description about the sample";
        }

        if (empty ($error)) {
            $target_dir = "../sample_images/";
            $target_file = $target_dir . rand() . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

            $uploadOk = 1;

            $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));


            if ($imageFileType == "") {
                $uploadOk = 2;
            } else {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "") {
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "eps" && $imageFileType != "svg") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image = htmlspecialchars($target_file);
                    //                    $sql = "INSERT INTO productss(ProductName,ProductPrice,ProductQty,ProductImage) VALUES('$ProductName','$ProductPrice','$ProductQty','$ProductImage')";
                    $sql = "UPDATE samples SET SampleId='$SampleId',Date='$Date',OrderId='$OrderId',BuyerID='$BuyerID',image='$image',SampleDescription='$SampleDescription' WHERE InternalIdS = '$InternalIdS'";
                    $conn->query($sql);
                    $SampleId = $Date = $OrderId = $BuyerID = $SampleDescription = $RecordeStatus = null;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else if ($uploadOk == 2) {
                $sql = "UPDATE samples SET SampleId='$SampleId',Date='$Date',OrderId='$OrderId',BuyerID='$BuyerID',SampleDescription='$SampleDescription' WHERE InternalIdS = '$InternalIdS'";
                $conn->query($sql);
                $SampleId = $Date = $OrderId = $BuyerID = $SampleDescription = $RecordeStatus = null;
            }
        }
    }
    $sql = "SELECT * FROM samples WHERE InternalIdS ='$InternalIdS'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $InternalIdS = $row['InternalIdS'];
        $SampleId = $row['SampleId'];
        $Date = $row['Date'];
        $OrderId = $row['OrderId'];
        $BuyerID = $row['BuyerID'];
        $image = $row['image'];
        $SampleDescription = $row['SampleDescription'];
    }
    ?>
    <div >
        <div >
        </div>
        <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="SampleId" class="form-label">New Sample Id</label>
                                <input type="text" class="form-control" id="SampleId" name="SampleId" style="width:130px"  value="<?php echo @$SampleId ?>" readonly>
                                <span class="text-danger"style="font-size:12px;" ><?php echo @$error['SampleId']; ?> </span>
                            </div>   
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="Date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="Date" style="width:155px; text-transform:capitalize;" name="Date" value="<?php echo @$Date; ?>">
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
                                <select  style="width:130px;" class="form-select" aria-label="Default select example" name="BuyerID" id="BuyerID">
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
                                </select>                                                       
                                <span class="text-danger"><?php echo @$error['BuyerID']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <?php
                                $sql = "SELECT * FROM orderdetails WHERE RecordeStatus ='Active' ";
                                $result = $conn->query($sql);
                                ?>
                                <label for="OrderId" class="form-label">Order Id</label>
                                <select style="width:135px;" class="form-select" aria-label="Default select example" name="OrderId" id="OrderId">
                                    <option>--Select Order ID--</option>
                                    <option>Not Start</option>                                    
                                    <?php
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_assoc()) {
                                            ?>                                    
                                                                                                                    <option value=" <?php echo $row['OrderId'] ?>" <?php if ($row['OrderId'] == @$OrderId) { ?> selected <?php } ?>> <?php echo $row['OrderId'] ?> </option>
                                                                                                                    <?php
                                        }
                                    }
                                    ?>
                                </select>                                                       
                                <span class="text-danger"><?php echo @$error['OrderId']; ?> </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="image" class="form-label">Sample image</label>
                                <input type="file" class="form-control" id="image" name="image" value="<?php echo @$image; ?>"/>                                
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['image']; ?> </span>
                            </div>
                        </div> 
                        <div class="col">
                            <div class="mb-3">
                                <label for="SampleDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="SampleDescription" name="SampleDescription" value="<?php echo @$SampleDescription; ?>" rows="2" cols="70"><?php echo @$SampleDescription; ?> </textarea>
                                <span class="text-danger" style="font-size:12px;"><?php echo @$error['SampleDescription']; ?> </span>
                            </div>
                        </div> 

                        <div class="col" >
                            <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
                                <input type="hidden" name="InternalIdS" value="<?php echo $InternalIdS; ?>">
                                <input type="hidden" name="operate" value="update">
                                <button style="background: #778899; color: white;" type="submit" class="btn ashs2" ><i class="fas fa-save"></i></button>   
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
$sql = "SELECT * FROM samples LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  samples.BuyerID WHERE InternalIdS = '$InternalIdS' ";
$result = $conn->query($sql);
?>
<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th>Sample Id </th>
            <th>Date</th>            
            <th>Buyer ID</th>
            <th>Buyer Name</th>
            <th>Order Id</th>
            <th>Artwork</th>
            <th>Description</th>          
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                                                <tr>
                                                    <td><?php echo $row['SampleId'] ?></td>
                                                    <td><?php echo $row['Date'] ?></td>
                                                    <td><?php echo $row['BuyerID'] ?></td>
                                                    <td><?php echo $row['BuyerName'] ?></td>
                                                    <td><?php echo $row['OrderId'] ?></td>  
                                                    <td>
                                                <div class="image-link">
                                                    <a href="<?php echo $row['image'] ?>" target="_blank">
                                                <img style="width:50px" src="<?php echo $row['image'] ?>" alt="Artwork">
                                                </a>
                                                    <div class="image-container">
                                                        <img src="<?php echo $row['image'] ?>" alt="Artwork">
                                                    </div>
                                                </div>
                                                 </td> 
                                                    <td><?php echo $row['SampleDescription'] ?></td>                  
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <?php
            }
        }
        ?>
    </tbody>
</table>
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
?> 