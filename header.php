<!DOCTYPE html>
<html lang="en">
<head>

    <title>Project Ethical Approval</title>


    <meta content="width=device-width, initial-scale=1.0" name="viewport" >

    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
    <link rel="stylesheet" href="css/appStyle.css">

</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">

                <img alt="logo" class="logo" src="images/logo.png">
            </a>

            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>

                <?php if (isset($_SESSION['usr_role'])) {
                    if ($_SESSION['usr_role'] == "admin") {
                        ?>
                        <li><a href="admin_usermanager.php">User Management</a></li>
                        <li><a href="#contact">Project Management</a></li>

                    <?php }
                    else if($_SESSION['usr_role'] == "student")
                    {
                        ?>
                        <li><a href="student_manageexperiments.php">Mange Experiments</a></li>

                        <?php

                    }
                }
                else { ?>
                    <li><a href="About.html">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                <?php
                }
                ?>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--http://codev1.azurewebsites.net/DirHtml/About.html-->
<!--                <li class="active"><a href="login.php">Sign In <span class="sr-only">(current)</span></a></li>-->

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['usr_id'])) { ?>
                        <li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php } else { ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Sign Up</a></li>
                    <?php } ?>
                </ul>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>