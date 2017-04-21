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
        $studentid = $_SESSION['usr_id'];

        if (isset($_POST['newfile'])) {
            if(isset($_FILES['uploaded_file'])) {

                // Make sure the file was sent without errors
                if($_FILES['uploaded_file']['error'] == 0) {

                    // Gather all required data
                    $name = $con-> real_escape_string($_FILES['uploaded_file']['name']);
                    $mime = $con->real_escape_string($_FILES['uploaded_file']['type']);
                    $data = $con->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
                    $size = intval($_FILES['uploaded_file']['size']);
                }

                    $expid = $_POST['expid'];


                //getting experiment details
                $result = mysqli_query($con, "SELECT * FROM experiments where id=" .$expid. " and studentid=" .$studentid);
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
                        echo "<div class=\"col-md-6\" style='height: 40px;'>EAO 1: " . $row['eao1'] . "</div>";
                        echo "<div class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>EAO 2: " . $row['eao2'] . "</div>";



                    }

                    $result->close();

                }



                if (!$error) {
                    ///
                    ///
                    ///
                    // Create the SQL query
                    $query = "INSERT INTO `file` (`expid`,`name`, `mime`, `size`, `data`, `created`)VALUES ('{$expid}','{$name}', '{$mime}', {$size}, '{$data}', NOW())";

                    // Execute the query
                    $result = $con->query($query);

                    // Check if it was successfull
                    if($result) {
                        ?>

                        <script language="JavaScript">
                            alert("Success! Your file was successfully added!");
                        </script>
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

                    }
                    else
                    {
                        echo '<p>There are no files in the database</p>';

                    }
                    }
                    else {
                        ?>

                        <script language="JavaScript">
                            alert("Error!");
                        </script>

                        <?php
                    }

                    ///
                    ///
                    ///

                }
            }
        }

        else
        {
            ?>
            <div class="container" style="margin-top:100px">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 well">
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registerexperimentform" enctype="multipart/form-data">
                            <fieldset>
                                <legend>New File</legend>

                                <div class="form-group">
                                    <input type="hidden" name="expid" value="<?php if (isset($expid)) { echo $expid; } ?>">
                                    <label for="name">File</label>
<!--                                    <input type="file" name="file" />-->

                                    <input type="file" name="uploaded_file"><br>


                                </div>


                                <div class="form-group">
                                    <input type="submit" name="newfile" value="Upload" class="btn btn-primary" />
                                </div>
                            </fieldset>
                        </form>
                        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                    </div>
                </div>

            </div>


            <?php
        }
    }
}
include_once 'footer.php';
?>