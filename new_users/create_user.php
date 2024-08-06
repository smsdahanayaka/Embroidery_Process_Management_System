<?php
ob_start();
include '../header.php';
include '../db_connection.php';
?>  
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);

    $error = array();

    $UserName = dataClean($UserName);
    if (empty($UserName)) {
        $error['UserName'] = "The Username should not be blank...!";
    }
    if (!empty($UserName)) { // third validation -- (3) check the email already in the database
        $sql = "SELECT * FROM userdetails WHERE UserName ='$UserName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { // methanadi ekakata wada wadipura thiyeda balanawa
            $error['UserName'] = "This User Name is already being used...!";
        }
    }
    $FirstName = dataClean($FirstName);
    if (empty($FirstName)) {
        $error['FirstName'] = "This field should not be blank...!";
    }

    $LastName = dataClean($LastName);
    if (empty($LastName)) {
        $error['LastName'] = "This field should not be blank...!";
    }

    $Email = dataClean($Email);
    if (empty($Email)) {
        $error['Email'] = "Email is required";
    }

    if (!empty($Email)) {
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $error['Email'] = "Invalid email format";
        }
    }
    if (!empty($Email)) {
        $sql = "SELECT * FROM userdetails WHERE UserName ='$UserName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $error['Email'] = "This email address is already being used...!";
        }
    }
    $IsAdmin = dataClean($IsAdmin);
    if (empty($IsAdmin)) {
        $error['IsAdmin'] = "Select the User type!";
    }
    $Password = dataClean($Password);
    if (empty($Password)) {
        $error['Password'] = "The Password should not be blank...!";
    }
    $PassConferm = dataClean($PassConferm);
    if (empty($PassConferm)) {
        $error['PassConferm'] = "Retype Password field Empty!";
    }

    if (!empty($PassConferm) && $Password != $PassConferm) {
        $error['PassConferm'] = "Retype Password not Mach!";
    }
if (empty($error)) {
    @$convertedPass = sha1($PassConferm);
    $sql = "INSERT INTO userdetails(UserName,Password,FirstName,LastName,Email,IsAdmin) VALUES('$UserName','$convertedPass','$FirstName','$LastName','$Email','$IsAdmin')";
    $conn->query($sql);
    $UserName=$Password=$FirstName=$LastName=$Email=$IsAdmin=$PassConferm=null;
    //header("Location:buyers_details.php");
}
    
}
?>

<div class="container" style="width: 70%;">

    <div class="card mt-2">
        <div class="card-header">
            <h4>Create User</h4>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="card-body">
                <div class="mb-1">
                    <label for="UserName" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo@$UserName; ?>" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['UserName']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo@$FirstName; ?>" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['FirstName']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo@$LastName; ?>" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['LastName']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Password" name="Email" value="<?php echo@$Email; ?>" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['Email']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="IsAdmin" class="form-label">User Type</label>
                    <select class="form-select" aria-label="Default select example" name="IsAdmin" id="IsAdmin">
                        <option value="">--Select Title--</option>
                        <option value="Admin" <?php if (@$IsAdmin == 'Admin') { ?>selected<?php } ?> >Admin</option>
                        <option value="User" <?php if (@$IsAdmin == 'User') { ?>selected<?php } ?>>User</option>
                    </select>
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['IsAdmin']; ?> </span>
                </div>
                <div class="mb-1">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" name="Password" value="<?php echo@$Password; ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['Password']; ?> </span>
                </div>

                <div class="mb-1">
                    <label for="PassConferm" class="form-label">Password Confirm</label>
                    <input type="password" class="form-control" id="PassConferm" name="PassConferm" value="<?php echo@$PassConferm; ?>">
                    <span class="text-danger" style="font-size:13px;"><?php echo @$error['PassConferm']; ?> </span>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-center">
                <button  style="background: #778899; color: white; width: 100px" type="submit" class="btn ashs2 m-1">Save</button>
                <button  style="background: #778899; color: white; width: 100px" type="reset" class="btn ashs2 m-1"value="Reset">Reset</button>
            </div>
        </form>
    </div>

</div>

<?php
include '../footer.php';
ob_flush();
?>  

