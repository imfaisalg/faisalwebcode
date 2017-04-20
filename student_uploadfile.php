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
        if (isset($_POST['newfile'])) {
            $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            $folder = "uploadedfiles/";

            // new file size in KB
            $new_size = $file_size / 1024;
            // new file size in KB

            // make file name in lower case
            $new_file_name = strtolower($file);
            // make file name in lower case

            $final_file = str_replace(' ', '-', $new_file_name);

            if (move_uploaded_file($file_loc, $folder . $final_file)) {

            $expid = $_POST['expid'];


                //getting experiment details
                $result = mysqli_query($con, "SELECT * FROM experiments where id=" .$expid);
                $num_rows = mysqli_num_rows($result);
                echo "<div class=\"row\" style='margin-top: 50px'>";
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
                    if (mysqli_query($con, "INSERT INTO uploadedfiles(expid,file,type,size) VALUES('" . $expid . "', '" . $final_file . "', '" . $file_type . "', '" . $new_size . "')")) {

                        ?>
                        <div class="row" style="margin-top: 50px">
                        <div class="col-md-12">
                        <table style="margin-left:auto;margin-right: auto;border: solid 1px #2a6496">
                        <tr class="row" style="background-color: #2a6496;color: white;height: 40px;">
<!--                            <th class="col-md-2">Experiment No.</th>-->
                            <th class="col-md-6">File Name</th>
<!--                            <th class="col-md-2">File Type</th>-->
<!--                            <th class="col-md-2">File Size(KB)</th>-->
                            <th class="col-md-6">View</th>
                        </tr>

                        <?php




                        //getting uploaded files list
                        $result = mysqli_query($con, "SELECT * FROM uploadedfiles where expid=" .$expid);
                        $num_rows = mysqli_num_rows($result);

                        if ($num_rows > 0) {


                            while ($row = $result->fetch_array()) {
                                echo "<tr class=\"row\" style='height: 40px;border-bottom: solid 1px #2a6496'>";
//                                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['expid'] . "</td>";
                                echo "<td class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['file'] . "</td>";
//                                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['type'] . "</td>";
//                                echo "<td class=\"col-md-2\" style='height: 40px;border-right: solid 1px #2a6496'>" . $row['size'] . "</td>";
                                echo "<td class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'> 
                                <a href=\"uploadedfiles/" . $row['file'] . "\" target=\"_blank\">view file</a></td>";

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
                            header("Location: student_manageexperiments.php");

                        } else {

                            $errormsg = "Error in creating...Please try again later!";
                        }
                    }


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
                                    <input type="file" name="file" />
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