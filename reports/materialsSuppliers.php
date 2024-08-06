<?php
include '../db_connection.php';
?>
<?php
extract($_POST);

//echo $BuyerIDFrom;
//echo $BuyerIDTo;
//echo $orderDateFrom;
//echo $OrderDateTo;
//echo $OrderStatus;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders Report</title>

        <!--Link for favicon-->
        <link rel="icon" href="<?php echo site_url; ?>images/favicon.ico">
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url; ?>css/fontawesome.min.css" rel="stylesheet" type="text/css"/>

        <link rel="icon" href="../images/favicon.ico">
        <link rel="stylesheet" href="style.css" media="all" />
        <link href="print.css" rel="stylesheet" type="text/css"/ media="print">
        <link href="<?php echo site_url; ?>css/fontawesome.min.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>


    <center> <img style="width: 5%; height: auto; margin-top: 10px;" src="logo.png"></center>
    <center> <h3>Material Suppliers Report</h3></center>

    <div class="row" style="margin-top: 30px">
        <div class="col"style="margin-left: 30px">Buyer Id From:&nbsp; &nbsp; <b><?php echo $MaterialIDFrom; ?></b></div>
        <div class="col">Buyer Id To:&nbsp; &nbsp; <b><?php echo $MaterialIDTo; ?></b></div>
        <div class="col">Sample Date From:&nbsp; &nbsp; <b><?php echo $SupplyDateFrom; ?></b></div>
        <div class="col">Sample Date To:&nbsp; &nbsp; <b><?php echo $SupplyDateTo; ?></b></div>

    </div>
    <center><hr style="width:95% "></center>

    <div class="container">
        <?php
        $MaterialIDFrom = str_replace(' ', '', $MaterialIDFrom);
        $MaterialIDTo = str_replace(' ', '', $MaterialIDTo);
        $SupplyDateFrom = str_replace(' ', '', $SupplyDateFrom);
        $SupplyDateTo = str_replace(' ', '', $SupplyDateTo);


        $sql = "SELECT * FROM materials_stocks_in WHERE "
                . "MaterialID BETWEEN ' $MaterialIDFrom' AND '$MaterialIDTo' "
                . "AND 	StockInDate  BETWEEN '$SupplyDateFrom' AND '$SupplyDateTo'";

        $result = $conn->query($sql);
        ?>
        <table class="table table-striped table-sm table-bordered" >
            <thead style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;">
                <tr>
                    <th style="font-size: 13px; text-align: center; ">Material Id</th>
                    <th style="font-size: 13px; text-align: center; ">Stock In Date</th>
                    <th style="font-size: 13px; text-align: center; ">Qt</th>
                    <th style="font-size: 13px; text-align: center; ">Suppler Name</th>
                    <th style="font-size: 13px; text-align: center; ">Suppler TP</th>
                    <th style="font-size: 13px; text-align: center; ">Suppler Email</th>
                    <th style="font-size: 13px; text-align: center; ">Suppler Address</th>




                </tr>
            </thead>
            <tbody id="myTable">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['MaterialID'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['StockInDate'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['Qt'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['SupplerName'] ?></td>
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['SupplerTP'] ?></td>                      
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['SupplerEmail'] ?></td> 
                            <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['SupplerAddress'] ?></td> 


                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table> 
    </div>
    <footer style="margin-top: 10px">       
        <div>      
            <div class="row" >
                <div class="col"style="margin-left: 30px">Report Date:&nbsp; &nbsp; <b><?php echo date("Y/m/d"); ?></b></div>
                <div class="col">Printed By:&nbsp; &nbsp; <b><?php echo $fiestname; ?></b>&nbsp;<b><?php echo $lastName; ?></b></div>

            </div>

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
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
</html>
