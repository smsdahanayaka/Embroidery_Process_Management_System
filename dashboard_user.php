<?php
include './header.php';
include './db_connection.php';
?>

<div class="cards sh ">
    <a href="<?php echo site_url; ?>buyers/buyers_details_User.php"> <div class="card-single shadow actives3">

            <div>
                <h1><?php
                    $sql = "SELECT  COUNT(InternalId) FROM buyerdetails  WHERE UseStstus = 'Active'";
                    $result = $conn->query($sql);
                    $count = mysqli_fetch_array($result);
                    echo $count['0'];
                    ?></h1>
                <span>Buyers</span>
            </div>
            <div>
                <span ><i class="fas fa-user-friends"></i></span>
            </div>
        </div>
    </a>
    <a href="<?php echo site_url; ?>orders/order_details.php">  <div class="card-single shadow actives3">
            <div>
                <h1><?php
                    $sql = "SELECT  COUNT(InternalId) FROM orderdetails WHERE RecordeStatus = 'Active'";
                    $result = $conn->query($sql);
                    $count = mysqli_fetch_array($result);
                    echo $count['0'];
                    ?></h1>
                <span>Orders</span>
            </div>
            <div>
                <span><i class="fas fa-business-time"></i></span>
            </div>
        </div>
    </a>

    <a href="<?php echo site_url; ?>sample_details/sample_details.php"> <div class="card-single shadow actives3">
            <div>
                <h1><?php
                    $sql = "SELECT  COUNT(InternalIdS) FROM samples WHERE RecordeStatus = 'Active'";
                    $result = $conn->query($sql);
                    $count = mysqli_fetch_array($result);
                    echo $count['0'];
                    ?></h1>
                <span>Samples</span>
            </div>
            <div>
                <span ><i class="fas fa-tasks"></i></span>
            </div>
        </div>
    </a>


    <a href="<?php echo site_url; ?>good_issue_notes/good_issue_note.php"> <div class="card-single shadow actives3">
            <div>
                <h1><?php
                    $sql = "SELECT  COUNT(InternalId) FROM good_issue_note WHERE RecordeStatus = 'Active'";
                    $result = $conn->query($sql);
                    $count = mysqli_fetch_array($result);
                    echo $count['0'];
                    ?></h1>
                <span>Delivery</span>
            </div>
            <div>
                <span ><i class="fas fa-truck"></i></span>
            </div>
        </div>
    </a>

</div> 

<!-- Rightside section table -->
<div class="recent-grid">
    <div class="project">
        <div class="card">
            <div class="card-header">
                <h3>Recent Orders</h3>
                <a href="<?php echo site_url; ?>orders/order_details.php"> <button>See all <span><i class="fas fa-arrow-circle-right"></i> 
                        </span></button></a>
            </div>
            <div class="card-body shadow">
                <div class="table-responsive">
                    <?php
                    $Status1 = "Finish";
                    $Status2 = "Ongoing";
                    $sql3 = "SELECT * FROM orderdetails LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  orderdetails.BuyerID WHERE Status ='$Status1' OR Status ='$Status2' AND RecordeStatus = 'Active' ";
                    $result = $conn->query($sql3);
                    ?>
                    <table width="100%" id="table_id" class="display">
                        <thead>
                            <tr>
                                <td>Order ID</td>
                                <td>Buyer Name</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <?php
                                    if ($row['Status'] == $Status1) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row['OrderId'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['BuyerName'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['Status'];
                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="';
                                        echo "status purple";
                                        echo '"></span>';
                                        echo "</td>";
                                        echo "</tr>";
                                    } else {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $row['OrderId'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['BuyerName'];
                                        echo "</td>";
                                        echo "<td>";
                                        echo $row['Status'];
                                        echo '&nbsp;&nbsp;<span class="';
                                        echo "status orange";
                                        echo '"></span>';
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="customers ">
        <div class="card ">
            <div class="card-header">
                <h3>Material Stocks</h3>
               <a href="<?php echo site_url; ?>material_stocks/total_stocks.php"> <button>See all <span><i class="fas fa-arrow-circle-right"></i> 
                        </span></button></a>
            </div>
            <div class="table-responsive">

                <?php
                $sql = "SELECT * FROM materials WHERE RecordeStatus = 'Active'";
                $result = $conn->query($sql);
                ?>

                <table width="100%">
                    <thead>
                        <tr>
                            <td>Material Name</td>
                            <td>Quantity</td>
                        </tr>
                    </thead>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td ><?php echo $row['MaterialName'] ?></td>
                                <td ><?php echo $row['Qt'] ?></td>
                               
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





<?php
include './footer.php';
?>    