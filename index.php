<?php

session_start();
include_once 'dbconnect.php';
include_once 'header.php';

?>
<div class="container main-content">


    <?php if (isset($_SESSION['usr_role'])) {
        if ($_SESSION['usr_role'] == "admin") {

            header("Location: admin_index.php");

        }
    }
    else {
        ?>

        <div class="jumbotron">
            <h1 style="text-align: center">Project Ethical Approval Monitoring</h1>

        </div>
<?php
    }
    ?>


    <!-- Main component for a primary marketing message or call to action -->


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<?php
include_once 'footer.php';
?>
