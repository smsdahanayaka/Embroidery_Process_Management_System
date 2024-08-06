<?php
session_start();
?>
<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login-TD Embroidery | Process_Management_System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link for Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--Link for external CSS-->
        <link rel="stylesheet" href="css/style-login.css">
        <!--Link for favicon-->
        <link rel="icon" href="images/favicon.ico">
        <!--font-awesome CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head >
    <body style="background-image: url('images/Background.png'); ">  
        <div class="container">
            <div class="row justify-content-md-center main" >
                <?php
                            
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    include 'db_connection.php'; //connection for the DB
                    extract($_POST);
                    $sql = "SELECT * FROM userdetails WHERE UserName ='$user_name' AND Password='" . sha1($password) . "'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $_SESSION['UserName'] = $row['UserName'];
                            $_SESSION['FirstName'] = $row['FirstName'];
                            $_SESSION['LastName'] = $row['LastName'];
                            $_SESSION['User_Role'] = $row['IsAdmin'];
                            $_SESSION['login_status'] = true;
                            $userRole = $row['IsAdmin'];
                        }
                         if ($userRole == "Admin") {
                                 header("Location:dashboard_admin.php");
                         }
                         if ($userRole != "Admin") {
                                 header("Location:dashboard_user.php");
                         }
                       
                    } else {
                        $error = "Invalid Username or Password";
                    }
                }
                ?>       
                <div class="col-md-4">
                    <div class="row justify-content-md-center main">
                        <img src="images/Logo.png" alt="" style="width: 45%; height: auto;">

                    </div>                    
                    <div class="card shadow-lg">
                        <div class="card-header" style="font-size:20px;font-weight: bold; color:#89716B;">
                            Login
                        </div>
                        <form method="POST"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="card-body">
                                <div class="mb-2">
                                    <div>
                                        <label for="user_name" class="form-label" class="form-label" style="font-size:13px;color:#89716B;" >User Name</label>
                                        <input type="text" class="form-control inp_back" id="user_name" name="user_name" style="font-size:13px;color:#89716B; background-color: white; font-family: 'Font Awesome 5 Free';" placeholder="&#xf007;" required>                                       
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div>
                                        <div>
                                            <label for="password" class="form-label" style="font-size:13px;color:#89716B; background-color: white;">Password</label>
                                            <input type="password" class="form-control inp_back" id="password" name="password" class="form-label" style="font-size:13px;color:#89716B; background-color: white; font-family: 'Font Awesome 5 Free'; font-weight: 600; " placeholder="&#xf084" required>
                                            <small password_error></small>
                                            <span span style="font-size:13px;color:#89716B; background-color: white;"><input type="checkbox" id="adventure_id" onclick="myFunction()" /> <label for="adventure_id">&nbsp;&nbsp;Show Password </label> </span>
                                            <div>
                                                <div style="font-size:13px;color:#89716B;">
                                                    <span text-align: center;><?php echo @$error ?> </span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer btn_position justify-content-center" >
                                        <button type="submit" class="login_btn ">Login</button>
                                    </div>
                                    </form>
                                </div>


                            </div>

                    </div>
                </div>

                <!-- Link for Bootstrap JS -->
                <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
                <script>
                                            //function for show password
                                            function myFunction() {
                                                var x = document.getElementById("password");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                } else {
                                                    x.type = "password";
                                                }
                                            }
                                                          </script>

                </body>
                </html>