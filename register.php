<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
$userRole = "";

if(isset($_SESSION['usr_id'])) {
   //
    if($_SESSION['usr_role']=="admin")
    {
?>

<div class="container" style="margin-top:100px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Sign Up</legend>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
</div>

<div class="form-group">
    <label for="name">Email</label>
    <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
</div>

<div class="form-group">
    <label for="name">Password</label>
    <input type="password" name="password" placeholder="Password" required class="form-control" />
    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
</div>

<div class="form-group">
    <label for="name">Confirm Password</label>
    <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
    <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
</div>


    <div class="form-group" style="display: inline">
        <input type="radio" name="userrole" value="student" checked="checked"> Student<br>
        <input type="radio" name="userrole" value="eao">EAO<br>
        <input type="radio" name="userrole" value="admin" > Admin<br>


    </div>



<div class="form-group">
    <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
</div>
</fieldset>
</form>
<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
</div>
</div>

</div>

<?php
//check if form is submitted
if (isset($_POST['signup'])) {
$name = mysqli_real_escape_string($con, $_POST['name']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);


//checking if its the first user in the system then create a 1st user with admin role

$result = mysqli_query($con, "SELECT * FROM users");

//if we have our 1st user it, should be an admin
    if(mysqli_num_rows($result)>0) {
$userRole = $_POST['userrole'];
//name can contain only alpha characters and space
if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $error = true;
    $userRole="";
    $name_error = "Name must contain only alphabets and space";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $userRole="";
    $email_error = "Please Enter Valid Email ID";
}
if (strlen($password) < 6) {
    $error = true;
    $userRole="";
    $password_error = "Password must be minimum of 6 characters";
}
if ($password != $cpassword) {
    $error = true;
    $userRole="";
    $cpassword_error = "Password and Confirm Password doesn't match";
}
if (!$error) {
    if(mysqli_query($con, "INSERT INTO users(name,email,password,userrole) VALUES('" . $name . "', '" . $email . "', '" .  md5($password) . "', '" . $userRole . "')")) {



        $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        $userRole="";

        header("Location: index.php");
    } else {
        $userRole="";
        $errormsg = "Error in registering...Please try again later!";
    }
}


}
//if we do not have any user then add is as admin a send an email to get it confirm via email
else
{
    $userRole = "admin";
    //user found in DB

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $userRole="";
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $userRole="";
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $userRole="";
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $userRole="";
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(name,email,password,userrole) VALUES('" . $name . "', '" . $email . "', '" .  md5($password) . "', '" . $userRole . "')")) {
            $userRole="";
            $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
        } else {
            $userRole="";
            $errormsg = "Error in registering...Please try again later!";
        }
    }

}
}

    }

    else
    {

        header("Location: index.php");
    }
}
else
{
    //if user is not set and db has no data then it should be 1st user as admin.
    $result = mysqli_query($con, "SELECT * FROM users");

//if we have our 1st user it, should be an admin



//if we have our 1st user it, should be an admin

    if(mysqli_num_rows($result)>0) {

         header("Location: index.php");
    }

    else

    {
        ///////////////////////////////////////////////////////////////
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        ///
        /// //////////////////////////////////////////

        //check if form is submitted
        if (isset($_POST['signup'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);


//checking if its the first user in the system then create a 1st user with admin role

            $result = mysqli_query($con, "SELECT * FROM users");

//if we have our 1st user it, should be an admin
            if(mysqli_num_rows($result)>0) {
                $userRole = $_POST['userrole'];
//name can contain only alpha characters and space
                if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
                    $error = true;
                    $name_error = "Name must contain only alphabets and space";
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = true;
                    $email_error = "Please Enter Valid Email ID";
                }
                if (strlen($password) < 6) {
                    $error = true;
                    $password_error = "Password must be minimum of 6 characters";
                }
                if ($password != $cpassword) {
                    $error = true;
                    $cpassword_error = "Password and Confirm Password doesn't match";
                }
                if (!$error) {
                    if(mysqli_query($con, "INSERT INTO users(name,email,password,userrole) VALUES('" . $name . "', '" . $email . "', '" .  md5($password) . "', '" . $userRole . "')")) {
                        $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
                        header("Location: index.php");
                    } else {
                        $errormsg = "Error in registering...Please try again later!";
                    }
                }


            }
//if we do not have any user then add is as admin a send an email to get it confirm via email
            else
            {
                $userRole = "admin";
                //user found in DB

                //name can contain only alpha characters and space
                if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                    $error = true;
                    $userRole="";
                    $name_error = "Name must contain only alphabets and space";
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $error = true;
                    $userRole="";
                    $email_error = "Please Enter Valid Email ID";
                }
                if(strlen($password) < 6) {
                    $error = true;
                    $userRole="";
                    $password_error = "Password must be minimum of 6 characters";
                }
                if($password != $cpassword) {
                    $error = true;
                    $userRole="";
                    $cpassword_error = "Password and Confirm Password doesn't match";
                }
                if (!$error) {
                    if(mysqli_query($con, "INSERT INTO users(name,email,password,userrole) VALUES('" . $name . "', '" . $email . "', '" .  md5($password) . "', '" . $userRole . "')")) {
                        $userRole="";
                        $successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
                    } else {
                        $userRole="";
                        $errormsg = "Error in registering...Please try again later!";
                    }
                }

            }
        }



        ?>

        <div class="container" style="margin-top:100px;">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                        <fieldset>
                            <legend>Sign Up</legend>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
                                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Password" required class="form-control" />
                                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="name">Confirm Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                            </div>


                            <?php if (isset($_SESSION['usr_id'])) {

        if($_SESSION['usr_role']=="admin")
        {
                                ?>
                                <div class="form-group" style="display: inline">
                                    <input type="radio" name="userrole" value="student" checked="checked"> Student<br>
                                    <input type="radio" name="userrole" value="eao">EAO<br>
                                    <input type="radio" name="userrole" value="admin" > Admin<br>
                                </div>
                            <?php }} else { ?>

                            <?php } ?>





                            <div class="form-group">
                                <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                            </div>
                        </fieldset>
                    </form>
                    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                </div>
            </div>

        </div>

        <?php


    }

}







?>


<?php
include_once 'footer.php';
?>


