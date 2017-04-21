<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
$userRole = "";

if(isset($_SESSION['usr_id'])) {
    //
    if ($_SESSION['usr_role'] == "eao") {
        $eaoid = $_SESSION['usr_id'];

        ?>
        <div class="row" style="margin-top:100px;">


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center">Experiment List</h2>
                </div>

                <div class="col-md-8 col-md-offset-2">
                    <table style="margin-left:auto;margin-right: auto;border: solid 1px #2a6496">
                        <tr class="row" style="background-color: #2a6496;color: white;height: 40px;">
                            <th class="col-md-3">Experiment Name</th>
                            <th class="col-md-7">Description</th>
                            <th class="col-md-2">View Detail</th>
                        </tr>


                        <?php


                        $result = mysqli_query($con, "SELECT * FROM experiments where eao1=" . $eaoid. " or eao2=".$eaoid );
                        $num_rows = mysqli_num_rows($result);

                        if ($num_rows > 0) {


                            while ($row = $result->fetch_array()) {
                                echo "<tr class=\"row\" style='height: 40px;border-bottom: solid 1px #2a6496'>";

                                echo "<td class=\"col-md-3\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['name'] . "</td>";
                                echo "<td class=\"col-md-7\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['description'] . "</td>";
                                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'> 
                                   <a href=\"eao_viewexperimentdetail.php?expid=" . $row ['id'] . "\" class=\"btn btn-info\"> View Detail</a> </td>";

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


