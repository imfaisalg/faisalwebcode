<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
$userRole = "";

if(isset($_SESSION['usr_id'])) {
    //
    if ($_SESSION['usr_role'] == "admin") {
        ?>
        <div class="row" style="margin-top:100px;">

        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 style="text-align: center">Experiment List</h2>
        </div>

        <div class="col-md-8 col-md-offset-2">
        <table style="margin-left:auto;margin-right: auto;border: solid 1px #2a6496">
        <tr class="row" style="background-color: #2a6496;color: white;height: 40px;">
            <th class="col-md-3">Experiment No.</th>
            <th class="col-md-3">Experiment Name</th>
            <th class="col-md-2">Description</th>
            <th class="col-md-2">EAO 1</th>
            <th class="col-md-2">EAO 2</th>
        </tr>


        <?php
        $result = mysqli_query($con, "SELECT * FROM experiments");
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {


            while ($row = $result->fetch_array()) {
                echo "<tr class=\"row\" style='height: 40px;border-bottom: solid 1px #2a6496'>";
                echo "<td class=\"col-md-3\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['id'] . "</td>";
                echo "<td class=\"col-md-3\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['name'] . "</td>";
                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['description'] . "</td>";

                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['eao1'] . "</td>";
                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['eao2'] . "</td>";


                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'> 
                                   <a href=\"admin_assigneaos.php?expid=" . $row ['id'] . "\" class=\"btn btn-info\"> Assign EAOs</a>                                 
                                    </td>";
                echo "</tr>";

            }

            $result->close();
            // cl ose connecti on t o dat abase
            $con->close();
        } else {

            ?>
            <div>
                <h3>Experiment data missing</h3>
            </div>
            <?php


        }
    }
                        ?>
                    </table>
                </div>
            </div>
        </div>


        <?php

}
include_once 'footer.php';
?>


