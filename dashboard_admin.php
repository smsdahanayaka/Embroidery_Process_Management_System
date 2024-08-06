<?php
include './header.php';
include './db_connection.php';
?>

<div class="cards sh ">
    <a href="<?php echo site_url; ?>buyers/buyers_details_admin.php"> <div class="card-single shadow actives3">

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


    <a href="<?php echo site_url; ?>invoice/invoice.php"> 
        <div class="card-single shadow-lg actives3">
            <div>
                <h1>Rs.<?php
                    $sql = "SELECT SUM(TotalAmount) FROM invoice";
                    $result = $conn->query($sql);
                    $sum = mysqli_fetch_array($result);  
                    $sum2 = $sum['0'];
                    $sum2 = $sum2/1000;
                    $sum2 = number_format($sum2);
                    echo $sum2."K";
                    ?></h1>&nbsp;
                &nbsp;<span>Income</span>

            </div>
            <div>
                <span><i class="fas fa-funnel-dollar"></i></span>
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


    <?php
    if ($userRole == "Admin") {

        echo '<div class="customers ">
        <div class="card ">
            <div class="card-header">
                <h3>Pending Payments</h3>
                <button>See all<span>&nbsp;<i class="fas fa-arrow-circle-right"></i>
                    </span></button>
            </div>
            
            
            <div class="table-responsive">';
        ?>
        <?php
        $sql3 = "SELECT * FROM payment_details LEFT JOIN buyerdetails ON  buyerdetails.BuyerID =  payment_details.BuyerID";
        $result = $conn->query($sql3);
        ?>
        <?php
        echo '<table width="100%">
                    <thead>
                        <tr>
                            <td>Buyer</td>
                            <td>Amount</td>
                        </tr>
                    </thead>
                    <tbody>';
        ?>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $Paid_Total = $row['Paid_Total'];
                $Invoice_total = $row['Invoice_total'];
                $BalancePayment = $Invoice_total - $Paid_Total;
                ?>
                <?php
                if ($BalancePayment > 0) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['BuyerName'];
                    echo "</td>";
                    echo "<td>Rs. &nbsp;";
                    echo number_format((float) $BalancePayment, 2, '.', '');
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
                <?php
            }
        }
        echo '</tbody>
</table>
</div>
</div>
</div>
</div>
</div>';
    }
    ?>





    <?php
    include './footer.php';
    ?>    