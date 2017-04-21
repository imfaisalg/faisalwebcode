<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';
//set validation error flag as false
$error = false;
$expid = 0;


if (isset($_GET["expid"])) {

    $expid = $_GET["expid"];

}else{
    $expid =0;
}

if(isset($_SESSION['usr_id'])) {
    //
    if ($_SESSION['usr_role'] == "student") {




        //getting experiment details
        $result = mysqli_query($con, "SELECT * FROM experiments where id=" . $expid);
        $num_rows = mysqli_num_rows($result);
        echo "<div class=\"row\" style='margin-top: 100px'>";
        echo "<h1 class=\"col-md-8 col-md-offset-2\" style='text-align: center'> Uploaded file list </h1>";
        echo "</div>";
        echo "<div class=\"row\" style='margin-top: 50px'>";
        echo "<div class=\"col-md-8 col-md-offset-2\">";
        if ($num_rows > 0) {


            while ($row = $result->fetch_array()) {

                echo "<div class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>Experiment No.: " . $row['id'] . "</div>";
                echo "<div class=\"col-md-6\" style='height: 40px;'>Experiment Name: " . $row['name'] . "</div>";
                echo "<div class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>Description: " . $row['description'] . "</div>";
                echo "<div class=\"col-md-6\" style='height: 40px;'>1st EAO  comments: " . $row['eao1comments'] . "</div>";
                echo "<div class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>2nd EAO : " . $row['eao2comments'] . "</div>";


            }

            $result->close();

        }


        ?>


        <div class="row" style="margin-top: 50px">
        <div class="col-md-12">
        <table style="margin-left:auto;margin-right: auto;border: solid 1px #2a6496">
        <tr class="row" style="background-color: #2a6496;color: white;height: 40px;">
            <th class="col-md-6">File Name</th>
            <th class="col-md-6">View</th>
        </tr>
        <?php
        //getting uploaded files list
        $result = mysqli_query($con, "SELECT * FROM file where expid=" . $expid);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {


            while ($row = $result->fetch_array()) {
                echo "<tr class=\"row\" style='height: 40px;border-bottom: solid 1px #2a6496'>";
                echo "<td class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['name'] . "</td>";
                echo "<td class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>
                                               <a href=\"getfile.php?id=" . $row ['id'] . "\" class=\"btn btn-info\"> View</a>";

                echo "</tr>";

            }

            $result->close();
            // cl ose connecti on t o dat abase
            $con->close();


            ?>
            </table>

            </div>
            </div>
            <?php
            // header("Location: student_manageexperiments.php");

        } else {
            echo '<p>There are no files in the database</p>';

        }
    }
}
include_once 'footer.php';
?>
