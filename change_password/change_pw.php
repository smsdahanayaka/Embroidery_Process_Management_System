<?php
ob_start();
include '../header.php';
include '../db_connection.php';
?>  
<?php
$userName = $_SESSION['UserName'];
$sql = "SELECT * FROM userdetails WHERE UserName ='$userName'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$password = $row[2];
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $error = array();

    $Password = dataClean($Password);
    if (empty($Password)) {
        $error['Password'] = "Please Enter Your Old Password!";
    }

    if (!empty($Password) && $password != sha1($Password)) {
        $error['Password'] = "Incorrect Current Password !";
    }
    $NewPass = dataClean($NewPass);
    if (empty($NewPass)) {
        $error['NewPass'] = "Please Enter Your new Password!";
    }

    $NewPassConferm = dataClean($NewPassConferm);
    if (empty($NewPassConferm)) {
        $error['NewPassConferm'] = "Retype Your New Password!";
    }

    if (!empty($NewPassConferm) && $NewPass != $NewPassConferm) {
        $error['NewPassConferm'] = "Retype Password Not Mach!";
    }

    @$convertedNewPass = sha1($NewPass);

    if (empty($error)) {
        $sql = "UPDATE userdetails SET Password='$convertedNewPass' WHERE UserName = '$userName'";
        $conn->query($sql);
        header("Location:dashboard.php");
    }
}
?>

<div class="container" style="width: 70%;">

    <div class="card mt-2">
        <div class="card-header">
            <h4>Change Password</h4>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">

                <div class="mb-1">
                    <label for="UserName" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo $_SESSION['UserName'] ?>" readonly> <!--this PHP block for keep the data already exist in the text field until it submit -->
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['UserName']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="Password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="Password" name="Password" value="<?php echo@$Password; ?>" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['Password']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="NewPass" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="NewPass" name="NewPass" value="<?php echo@$NewPass; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['NewPass']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="NewPassConferm" class="form-label">New Password Confirm</label>
                    <input type="password" class="form-control" id="NewPassConferm" name="NewPassConferm" value="<?php echo@$NewPassConferm; ?>">
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['NewPassConferm']; ?> </span>
                </div>

            </div>
            <div class="card-footer justify-content-center">
                <center><button style="background: #778899; color: white; width: 100px" type="submit" class="btn ashs2">Save</button></center>
            </div>
        </form>
    </div>

</div>

<?php
include '../footer.php';
ob_flush();
?>  

