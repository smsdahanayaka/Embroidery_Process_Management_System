<?php
ob_start();
include '../header.php';
include '../db_connection.php';
$fiestname = $_SESSION['FirstName'];
$lastName = $_SESSION['LastName'];
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%">Material Stocks </h3>

    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; margin-left: 30%;" ">

</div>
<!--New Metrial Insert Start here-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        extract($_POST);

        $error = array();

        if (empty($UoM)) {
            $error['UoM'] = "The UoM is required";
        }
        $MaterialName = dataClean($MaterialName);
        if (empty($MaterialName)) {
            $error['MaterialName'] = "Please Enter the Material Name";
        }

        if (empty($error)) {
            $RecordeStatus = "Active";
            $Qt = 0;
            $sql1 = "INSERT INTO materials(MaterialID,MaterialName,UoM,Qt,RecordeStatus) VALUES('$MaterialID','$MaterialName','$UoM','$Qt','$RecordeStatus')";
            $conn->query($sql1);

            $fiestname = str_replace(' ', '', $fiestname);
            $lastName = str_replace(' ', '', $lastName);

            $notifaction = "New Material added";
            $notifactionId = "0";
            $date = date("Y-m-d h:i:sa");
            date_default_timezone_set("Asia/Colombo");
            $time = date("h:i:sa");
            $activityDoneBy = "By " . $fiestname . " " . $lastName;
            $sql7 = "INSERT INTO notifications (operationId,message,activityDoneBy,date,time,status) VALUES('$SampleId','$notifaction','$activityDoneBy','$date','$time','$notifactionId')";
            $conn->query($sql7);

            $MaterialName = $UoM = null;
        }
        header("Location:total_stocks.php");
    }
    ?>
    <div >

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <?php
            if ($userRole == "Admin") {
                echo '      <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="MaterialID" class="form-label">New Material ID</label>
                                <input type="text" class="form-control" id="MaterialID" name="MaterialID"  value=" ';
                echo idGenerator('MAT', 'materials', 'MaterialID', 'MaterialID');
                echo ' " readonly>
            <span class="text-danger "style="font-size:12px;" > ';
                echo @$error['MaterialID'];
                echo ' </span>
    </div>   
</div>
<div class="col">
    <div class="mb-3">
        <label for="MaterialName" class="form-label">Material Name</label>
        <input type="text" class="form-control" id="MaterialName" style="width:286px; text-transform:capitalize;" name="MaterialName" value=" ';
                echo ' "><span class="text-danger"style="font-size:12px;" > ';
                echo@$MaterialName;
                echo @$error['MaterialName'];
                echo '           </span>
    </div>
</div>
<div class="col">
    <div class="mb-3">
        <label for="UoM" class="form-label">UoM</label>
        <select class="form-select" aria-label="Default select example" name="UoM" id="UoM">
            <option value="">--Select Title--</option>
            <option value="Cones" ';
                if (@$UoM == 'Cones') {
                    echo ' selected  ';
                }
                echo '  >Cones</option>
            <option value="Meters" ';
                if (@$UoM == 'Meters') {
                    echo ' selected  ';
                }
                echo ' >Meters</option>
            <option value="Yard" ';
                if (@$UoM == 'Yard') {
                    echo ' selected  ';
                }
                echo ' >Yard</option>
            </select>
            <span class="text-danger" style="font-size:12px;"> ';
                echo @$error['UoM'];
                echo ' </span>
    </div>
</div>                     
<div class="col" >
    <div class="mb-3 " style="padding-top: 31px; padding-left: 30px;">
        <button style="background: #778899; color: white;" type="submit" class="btn ashs2 " ><i class="fas fa-save"></i></button>
        <button style="background: #778899; color: white;" type="reset" class="btn ashs2 "><i class="fas fa-undo-alt"></i></button>
    </div> 
</div>                                            
</div>                          
</div>
</div> ';
            }
            ?>


        </form>
    </div>

</div>
<!--New Metrial Insert End here-->
<?php
$sql = "SELECT * FROM materials WHERE RecordeStatus = 'Active'";
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
            <th style="font-size: 13px; text-align: center; ">Material ID</th>
            <th style="font-size: 13px; text-align: center; ">Material Name</th>
            <th style="font-size: 13px; text-align: center; ">UoM</th>
            <th style="font-size: 13px; text-align: center; ">Quantity</th>
            <?php
            if ($userRole == "Admin") {
                echo ' <th style="font-size: 13px; width:60px">Stock In</th>';
            }
            ?>
            <th style="font-size: 13px; width:80px" ">Stock Out</th>
            <?php
            if ($userRole == "Admin") {
                echo '  <th style="font-size: 13px; text-align: center;width:80px; ">Remove</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['MaterialID'] ?></td>
                    <td style="font-size: 12px; font-weight: bold;  vertical-align: middle; text-align: center;"><?php echo $row['MaterialName'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['UoM'] ?></td>
                    <td style="font-size: 12px; font-weight: bold; vertical-align: middle; text-align: center;"><?php echo $row['Qt'] ?></td>

                    <?php
                    if ($userRole == "Admin") {
                        echo ' <td style=width:60px"> ';
                    }
                    ?>

            <form method="post" action="<?php echo site_url; ?>material_stocks/stocks_in.php">
                <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                <?php
                if ($userRole == "Admin") {
                    echo '   <button  style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-sign-in-alt"></i></button> ';
                }
                ?>               
            </form>
            <?php
            if ($userRole == "Admin") {
                echo '  </td> ';
            }
            ?>

            <td style=width:100px">
                <form method="post" action="<?php echo site_url; ?>material_stocks/stocks_out.php">
                    <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                    <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="submit"><i class="fas fa-sign-out-alt"></i></button>
                </form>

            </td>

            <?php
            if ($userRole == "Admin") {
                echo '   <td style="margin-left: 20px ">';
            }
            ?>

            <form  id="remove_form<?php echo $row['InternalId']; ?>" method="post" action="<?php echo site_url; ?>material_stocks/remove.php">
                <input type="hidden" name="InternalId" value="<?php echo $row['InternalId']; ?>">
                <?php
                if ($userRole == "Admin") {
                    echo ' <button style="background: #dcdcdc; color: white;" class="btn btn-sm ashs" type="button" onclick="removeRecord( ';
                    echo " 'remove_form ";
                    echo $row['InternalId'];
                    echo " ') ";
                    echo ' "><i class="fas fa-eraser"></i></button> ';
                }
                ?>      
            </form>
            <?php
            if ($userRole == "Admin") {
                echo '</td>';
            }
            ?>
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
ob_flush();
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