

<?php

session_start();

include_once 'header.php';
include_once 'dbconnect.php';
?>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<div class="row" style="margin-top:100px;">
    <div class="col-md-8 col-md-offset-2">

        <a href="register.php" class="btn btn-success">Register User</a>
    </div>

    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <h2 style="text-align: center">User list</h2>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <table style="margin-left:auto;margin-right: auto">
                <tr style="background-color: #2a6496;color: white">
                    <th>User action</th>
                    <th>Name</th>
                    <th>EMail</th>
                    <th>Role</th>
                </tr>



                <?php
                $result = mysqli_query($con, "SELECT * FROM users");
                $num_rows = mysqli_num_rows($result);

                if ($num_rows > 0) {


                    while ($row = $result->fetch_array()) {
                        echo "<tr>";
                        echo "<td> 
                                    <a href=\"admin_editUser.php?usr_id=". $row ['id'] ."\" class=\"btn btn-info\"> Edit</a>
                                    <a href=\"admin_deleteUser.php?usr_id=". $row ['id'] ."\" class=\"btn btn-danger\"> Delete</a>
                                    </td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['userrole'] . "</td>";
                        echo "</tr>";

                    }

                    $result->close();
                    // cl ose connecti on t o dat abase
                    $con->close();
                }
                else
                {

                    ?>
                    <div>
                        <h3>no data</h3>
                    </div>
                    <?php

                    while ($row = $result->fetch_array()) {
                        echo "<li>" . $row ['id'] . "-" . $row ['name'] . "-" . $row ['email'] . "-" . $row ['password'] . "-" . $row ['userrole'] . "</li>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php

include_once 'footer.php';
?>