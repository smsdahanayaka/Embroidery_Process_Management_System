<?php
include 'config.php';
include 'db_connection.php';
session_start();
if (!isset($_SESSION['login_status'])) {
    header("Location:dashboard.php");
}
?>
<?php
$userName = $_SESSION['UserName'];
$sql = "SELECT * FROM userdetails WHERE UserName ='$userName'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$password = $row[2];
$userRole = $_SESSION['User_Role'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login-TD Embroidery | Process_Management_System</title>
        <!--Link for favicon-->
        <link rel="icon" href="<?php echo site_url; ?>images/favicon.ico">
        <link href="<?php echo site_url; ?>css/style.css" rel="stylesheet" type="text/css"/>
        <!--link for dashboard style-->
        <link href="<?php echo site_url; ?>css/Dashboard_style.css" rel="stylesheet" type="text/css"/>
        <!--line-awesome css links-->
        <link href="<?php echo site_url; ?>css/line-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url; ?>css/all.min.css" rel="stylesheet" type="text/css"/>
        <!--Link for sweet alert-->
        <script src="<?php echo site_url; ?>js/sweetalert.min.js" type="text/javascript"></script>
        <script src="<?php echo site_url; ?>js/sweetalert2.all.min.js" type="text/javascript"></script>
        <link href="<?php echo site_url; ?>css/dashboard_style2.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url; ?>css/fontawesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo site_url; ?>css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

        <style>
            #notCount{
                border-radius: 50%;
                position: relative;
                top:-10px;
                left: -10px;
            }
            th {
                cursor: pointer;
            }
            .ashs:hover{
                background:#99A799 !important ;
            } 
            .ashs2:hover{
                background:#323b43 !important ;
            }     
        </style>   
       <style>
        /* Add custom CSS for wider notification detail area */
        .dropdown-menu-end {          
            max-height: 500px; /* Maximum height for the dropdown menu */
            overflow-y: auto; /* Enable vertical scrolling */
        }
    </style>
    </head>
    <body class="sb-nav-fixed ">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark Larger shadow">
            <!-- Navbar Brand-->

            <a class="navbar-brand ps-3" href="" style="width: 14%; height: auto; margin-left: 2%;" >TD Embroidery</a>            

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="sb-sidenav-footer" style="color:#B9B9B9; margin-top: 8px;">
                    Welcome! &nbsp;  <?php echo $_SESSION['FirstName']; ?> <?php echo $_SESSION['LastName'] ?> &nbsp; &nbsp; &nbsp; 
                </div>

                <!-- Notification DropDown-->
                <?php
                $sql5 = "SELECT  COUNT(InternalId) FROM notifications  WHERE status = '0'";
                $result5 = $conn->query($sql5);
                $notificationCount = mysqli_fetch_array($result5);
                ?>
                <li class="nav-item dropdown" >
                    <a class="nav-link " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell"></i>&nbsp;<span class="badge bg-danger" id="notCount"><?php echo $notificationCount['0']; ?></span> </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> 

                        <?php
                        $sql6 = "SELECT  *  FROM notifications  WHERE status = '0'";
                        $result6 = $conn->query($sql6);
                        if ($result6->num_rows > 0) {
                            while ($row = $result6->fetch_assoc()) {
                                if ($userRole == "Admin") {
                                    echo '<a style="font-size:12px" class="dropdown-item actives" href="' . site_url2 . '?id=' . $row["InternalId"] . '">' . $row["operationId"] . '<br>' . $row["message"] . '<br>' . $row["activityDoneBy"] . '<br>' . $row["date"] . '&nbsp; - &nbsp;' . $row["time"] . '</a>';
                                    echo '<hr>';
                                } else {
                                    echo '<a style="font-size:12px; pointer-events: none;" class="dropdown-item actives" href="' . site_url2 . '?id=' . $row["InternalId"] . '">' . $row["operationId"] . '<br>' . $row["message"] . '<br>' . $row["activityDoneBy"] . '<br>' . $row["date"] . '&nbsp; - &nbsp;' . $row["time"] . '</a>';
                                    echo '<hr>';
                                }
                            }
                        } else {
                            echo '<a class="dropdown-item actives" href="#">No any new Notifications</a>';
                        }
                        ?> 

                    </ul>
                </li> 

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">  
                        <?php
                        if ($userRole == "Admin") {
                            echo '<li><a class="dropdown-item actives" href="';
                            echo site_url;
                            echo 'new_users/create_user.php">Create User</a></li>';
                        }
                        ?>  
                        <li><a class="dropdown-item actives" href="<?php echo site_url; ?>change_password/change_pw.php">Change Password</a></li>
                        <li><a class="dropdown-item actives" href="<?php echo site_url; ?>oldNotifications.php">Old Notifications</a></li>                        
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item actives" href="<?php echo site_url; ?>logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="navbar-brand ps-3" href=""><img src="<?php echo site_url; ?>images/dashboard_image.png" a"dashboard.php"lt="" style="width: 35%; height: auto; margin-left: 30%;  margin-bottom: 1rem;"/></a> 

                            <a class="nav-link actives" href=" <?php
                            if ($userRole == "Admin") {
                                echo site_url;
                                echo 'dashboard_admin.php">';
                            } else {
                                echo site_url;
                                echo 'dashboard_user.php">';
                            }
                            ?> 
                               <div class="sb-nav-link-icon "><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                        </a>
                        <a class="nav-link actives" href="
                        <?php
                        if ($userRole == "Admin") {
                            echo site_url;
                            echo 'buyers/buyers_details_admin.php">';
                        } else {
                            echo site_url;
                            echo 'buyers/buyers_details_User.php">';
                        }
                        ?>
                           <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Buyer Details
                    </a>
                    <a class="nav-link actives" href="<?php echo site_url; ?>sample_details/sample_details.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-vials"></i></div>
                        Sample Details
                    </a>
                    <a class="nav-link collapsed actives" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-business-time"></i></div>
                        Order Details
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link actives" href="<?php echo site_url; ?>orders/order_details.php">New Orders</a>
                            <a class="nav-link actives" href="<?php echo site_url; ?>orders/finish_Order_details.php">Finish Orders</a>
                        </nav>
                    </div>

                    <a  class="nav-link collapsed actives" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></i></div>
                        Payment Details
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link actives" href="<?php echo site_url; ?>quotations/quotations.php">Quotations</a>
                            <a class="nav-link actives" href="<?php echo site_url; ?>invoice/invoice.php">Invoices</a>
                            <?php
                            if ($userRole == "Admin") {
                                echo '<a class="nav-link actives" href="';
                                echo site_url;
                                echo 'payments/payments.php">Payments</a> ';
                            }
                            ?>                                   
                        </nav>
                    </div>
                    <a class="nav-link actives" href="<?php echo site_url; ?>material_stocks/total_stocks.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-boxes"></i></div>
                        Material Stocks
                    </a>
                    <a class="nav-link actives" href="<?php echo site_url; ?>good_issue_notes/good_issue_note.php">
                        <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
                        Good Issue Notes
                    </a>
                    <a class="nav-link actives" href="   <?php
                    if ($userRole == "Admin") {
                        echo site_url;
                        echo 'reports/reports_Admin.php">';
                    } else {
                        echo site_url;
                        echo 'reports/reports_user.php">';
                    }
                    ?>
                       <div class="sb-nav-link-icon"><i class="fas fa-file-import"></i></div>
                        Reports
                    </a>


            </div>
        </div>

    </nav>
</div>  



<div id="layoutSidenav_content">
    <main>
        <script>
            function goToSettings(form_id) {
//                         alert(form_id);
//                        var x = document.getElementById(settings)
                Swal.fire({
                    title: 'Enter Your Password',
                    html: `<input type="password" id="password" class="swal2-input" value="<?php echo @sha1(password); ?>"  placeholder="Password"> `,
                    confirmButtonText: 'Sign in',
                    focusConfirm: false,
                    preConfirm: () => {


                        const password = Swal.getPopup().querySelector('#password').value;



                        if (!password) {
                            Swal.showValidationMessage(`Please enter password`)
                        }

                        return {password: password}
                    }
                }).then((result) => {
                    Swal.fire(`
                    Password: ${result.value.password}
                    `.trim())
                })
            }
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>
