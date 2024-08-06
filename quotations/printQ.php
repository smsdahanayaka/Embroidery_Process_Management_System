<?php
include '../db_connection.php';
?>
<?php
extract($_POST);
?>
<?php
$sql = "SELECT * FROM quotations WHERE quotationId  ='$quotationId'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $InternalId = $row['InternalId'];
    $date = $row['Date'];
    $BuyerID = $row['BuyerID'];
    $GrossAmount = $row['GrossAmount'];
    $DiscountRate = $row['DiscountRate'];
    $TotalAmount = $row['NetAmount'];
    $next_due_date = date('Y-m-d', strtotime($date . ' +30 days'));
}
?> 

<?php
$sq2 = "SELECT * FROM buyerdetails WHERE BuyerID  ='$BuyerID'";
$result2 = $conn->query($sq2);
if ($result2->num_rows > 0) {
    $row = $result2->fetch_assoc();

    $Title = $row['Title'];
    $BuyerName = $row['BuyerName'];
    $Address = $row['Address'];
    $Email = $row['Email'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>  
        <link rel="icon" href="../images/favicon.ico">
        <link rel="stylesheet" href="style.css" media="all" />
        <link href="print.css" rel="stylesheet" type="text/css"/ media="print">
        <link href="<?php echo site_url; ?>css/fontawesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header class="clearfix">        
            <div  id="logo">
                <img style="width: 105px ;height: auto;" src="logo.png">
            </div>
            <div id="company">
                <h2 class="name"><b>TD Embroidery</b></h2>
                <div>NO. 341E/1,KANDY ROAD,</div>
                <div>KIRILLAWALA,WEBADA.</div>
                <div>0776941583</div>
                <div><a href="mailto:company@example.com" style="color:#4A4746">tharangaemb@yahoo.com</a></div>
            </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client" style="border-left: 6px solid #4A4746;">
                <div class="to">QUOTATION TO:</div>
                <h2 class="name"><?php echo $Title . $BuyerName; ?></h2>
                <div class="address"><?php echo $Address; ?></div>
                <div class="email" ><a style="color:#4A4746" href="#"><?php echo $Email; ?></a></div>
            </div>
            <div id="invoice">
                <h1 style="color:#4A4746 "><b>QUOTATION</b></h1>
                <div >Quotation Id:<b> <?php echo $quotationId; ?></b></div>
                <div class="date">Date of Quotation: <?php echo $date; ?></div>                
                <div class="date">Due Date:<?php echo $next_due_date; ?> </div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no" style="font-size: 17px;  vertical-align: middle; text-align: center; background:#4A4746; ">Buyer ID</th>
                    <th class="desc" style="font-size: 17px;  vertical-align: middle; text-align: center;">Description</th>
                    <th class="unit" style="font-size: 17px;  vertical-align: middle; text-align: right; ">Qty</th>
                    <th class="qty" style="font-size: 17px;  vertical-align: middle; text-align: right; " >Rate(Rs.)</th>
                    <th class="total" style="font-size: 17px;  vertical-align: middle; text-align: right; background:#4A4746; ">Amount (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql4 = "SELECT * FROM quotations_items WHERE quotationId  ='$quotationId'";
                $result4 = $conn->query($sql4);
                if ($result4->num_rows > 0) {
                    while ($row = $result4->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="no" style="font-size: 15px;  vertical-align: middle; text-align: center; background:#696260;"><?php echo $BuyerID; ?></td>
                            <td class="desc" style="font-size: 15px;  vertical-align: middle; "><?php echo $row['description'] ?> </td>
                            <td class="unit" style="font-size: 15px;  vertical-align: middle; "><?php echo $row['qty'] ?></td>
                            <td class="qty"><?php echo $row['rate'] ?></td>
                            <td class="total" style="background:#696260;"><?php echo $row['amount'] ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Subtotal(Rs.)</td>
                    <td><?php echo $GrossAmount; ?></td>
                </tr>           
                <tr style="border-bottom-color:#4A4746 ">
                    <td colspan="2"></td>
                    <td colspan="2">Discount %</td>
                    <td><?php echo $DiscountRate; ?></td>                    
                </tr>
                <tr >
                    <td colspan="2" style="border-bottom-color:#4A4746 "></td>
                    <td style="color:#4A4746 " colspan="2">Total Amount (Rs.)</td>
                    <td style="color:#4A4746 "><?php echo $TotalAmount; ?></td>
                </tr>
            </tfoot>
        </table>
        <div id="thanks">Thank you!</div>
        <div  style="border-left: 6px solid #4A4746;" id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>

    <footer>

        Quotation was created on a computer and is valid without the signature and seal.
        <div>        
            <button  onclick="window.print()" style="margin-top: 5px; font-family: arial;
                     font-weight: bold;
                     color: #F7ECE6 ;
                     font-size: 16px;
                     text-shadow: 1px 1px 0px #131A21;
                     box-shadow: 1px 1px 1px #BEE2F9;
                     padding: 10px 25px;
                     border-radius: 24px;
                     border: 0px solid #3866A3;
                     background: #4A4746;
                     background: linear-gradient(to top, #89716B, #4A4746);" id="print-btn"> Print<span><i class="fas fa-print"></i></span> </button>
        </div>
    </footer>
</body>
</html>