<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
$userRole = "";

if(isset($_SESSION['usr_id'])) {
    //
    if ($_SESSION['usr_role'] == "student") {
        ?>
        <div class="row" style="margin-top:100px;">
        <div class="col-md-8 col-md-offset-2">

            <a href="register2.php" class="btn btn-success">New Experiment</a>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 style="text-align: center">Experiment List</h2>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <table style="margin-left:auto;margin-right: auto">
                    <tr style="background-color: #2a6496;color: white">
                        <th>User action</th>
                        <th>Experiment Name</th>
                        <th>Ethical Approval File</th>
                        <th>Supplementry File</th>
                    </tr>


                    <?php
                    $result = mysqli_query($con, "SELECT * FROM experiments");
                    $num_rows = mysqli_num_rows($result);

                    if ($num_rows > 0) {


                        while ($row = $result->fetch_array()) {
                            echo "<tr>";
                            echo "<td> 
                                    <a href=\"admin_editUser.php?usr_id=" . $row ['id'] . "\" class=\"btn btn-info\"> Edit</a>
                                    <a href=\"admin_deleteUser.php?usr_id=" . $row ['id'] . "\" class=\"btn btn-danger\"> Delete</a>
                                    </td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['file1'] . "</td>";
                            echo "<td>" . $row['file2'] . "</td>";
                            echo "</tr>";

                        }

                        $result->close();
                        // cl ose connecti on t o dat abase
                        $con->close();
                    } else {

                        ?>
                        <div>
                            <h3>no data</h3>
                        </div>
                        <?php


                    }
                    ?>
                </table>
            </div>
        </div>
        </div>


        <?php
    }
}
include_once 'footer.php';
?>


