<?php
include 'header.php';
include 'db_connection.php';
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom" style="margin-left: 10px">
    <h3 class="h3" style="color: #4B4847; margin-left: 2%; width: 500px;  ">Notifications | Old</h3>  
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
    <input type="text" class="form-control" id="Search" name="Search"  value=""  placeholder="Search"  style="width:300px; ">

</div>

<?php
$sql = " SELECT * FROM  notifications WHERE status = '1'";
$result = $conn->query($sql);
?>
<table class="table table-hover table-sm table-bordered" id="myTable2">
    <thead  >

        <tr style="background-color:#646a70; color: white; text-align: center; vertical-align: middle; height: 40px;" >
            <th style="font-size: 13px; text-align: center; ">Operation Is</th>
            <th style="font-size: 13px; text-align: center; ">Notification</th>
            <th style="font-size: 13px; text-align: center; ">Date</th>
            <th style="font-size: 13px; text-align: center; ">Time</th>    
        </tr>
    </thead>
    <tbody id="myTable" >
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>

                <tr>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['operationId'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['message'] ?>&nbsp;<?php echo $row['activityDoneBy'] ?></td>   
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['date'] ?></td>
                    <td style="font-size: 12px;  vertical-align: middle; text-align: center;"><?php echo $row['time'] ?></td>                        
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
include 'footer.php';
?> 
<script>
//    function for search
    $(document).ready(function () {
        $('#Search').keyup(function () {
            search_table($(this).val());
        });
        function search_table(value) {
            $('#myTable tr').each(function () {
                var found = 'false';
                $(this).each(function () {
                    if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                    {
                        found = 'true';
                    }
                });
                if (found == 'true') {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
    var table = '#myTable2';
    $('#maxRows').on('change', function () {
        $('.pagination').html('');
        var trnum = 0;
        var maxRows = parseInt($(this).val());
        var totalRows = $(table + ' tbody tr').length;
        $(table + ' tr:gt(0)').each(function () {
            trnum++;
            if (trnum > maxRows) {
                $(this).hide();
            }
            if (trnum <= maxRows) {
                $(this).show();
            }
        });
        if (totalRows > maxRows) {
            var pagenum = Math.ceil(totalRows / maxRows);
            for (var i = 1; i <= pagenum; ) {
                $('.pagination').append('<li class="page-item" data-page="' + i + '"><a class="page-link" href="#">\<span>' + i++ + '<span class="sr-only page-item">(current)</span></span>\</a></li>').show();
            }
        }
        $('.pagination li:first-child').addClass('active');
        $('.pagination li').on('click', function () {
            var pageNum = $(this).attr('data-page');
            var trIndex = 0;
            $('.pagination li').removeClass('active');
            $(this).addClass('active');
            $(table + ' tr:gt(0)').each(function () {
                trIndex++;
                if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>