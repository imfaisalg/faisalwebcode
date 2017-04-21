<?php

session_start();

if(isset($_SESSION['usr_id'])!="") {
    header("Location: index.php");
}

include 'header.php';
include_once 'dbconnect.php';



$result = mysqli_query($con, "SELECT * FROM users");
$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {





//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        $_SESSION['usr_role'] = $row['userrole'];

        //if admin

        if ($row['userrole'] == "admin") {
            header("Location: admin_index.php");
        }
        else
        {
        header("Location: index.php");
        }
    } else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}
?>


<div class="container" style="margin-top:100px">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>Login</legend>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>

</div>

    <?php
    }
    else {


    header("Location: register.php");
}
?>
<?php
include_once 'footer.php';
?>
