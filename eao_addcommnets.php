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
    if ($_SESSION['usr_role'] == "eao") {
        $eaoid = $_SESSION['usr_id'];


        if (isset($_POST['addcomments'])) {



            $isvalideao1 = $_POST['isvalideao1'];
          // $eao1comments = htmlentities($_POST['eaofirstcommnets']);
          //  $eao2comments = htmlentities($_POST['eaofirstcommnets']);


            $expid = $_POST['expid'];
            $val1 = $isvalideao1;



            ?>

            <?php

            if($val1==1)
            {
                $val2 =$_POST['eaofirstcommnets'];
                ?>
                <script language="JavaScript">

                    alert(<?php echo $val2  ?>);
                    alert(<?php echo $val1  ?>);



                </script>
                <?php
            }
            //UPDATE `experiments` SET `eao1comments`="sdfds",`eao2comments`"sdfds" WHERE 1
            $updatequery=mysqli_query($con,"Update experiments set eao1comments='.$eao1comments.',eao2comments='.$eao2comments.' where id='$expid'");

           // $updatequery = mysqli_query($con, "Update experiments set eao1comments='$eao1comments',eao2commnets='$eao2comments' where id='$expid'");

            // $updatequery = mysqli_query("UPDATE experiments SET eao1=" . 1 .",eao2=" . 2 . " WHERE id=". 6, $con);

            if ($updatequery) {
                ?>

                <script language="JavaScript">
                    alert("Updated!");
                    header("Location: eao_manageexperimentss.php");

                </script>
                <?php
            } else {
                ?>
                <script language="JavaScript">
                    alert("DB error!");
                    header("Location: eao_manageexperimentss.php");

                </script>
                <?php
            }


        } else {
            ?>

            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="addcommentsform">
                <?php
                //getting experiment details
                $result = mysqli_query($con, "SELECT * FROM experiments where id=" . $expid . " and (eao1=" . $eaoid . " or eao2=" . $eaoid . ")");
                $num_rows = mysqli_num_rows($result);
                echo "<div class=\"row\" style='margin-top: 100px'>";
                echo "<h1 class=\"col-md-8 col-md-offset-2\" style='text-align: center'> Add comments </h1>";
                echo "</div>";
                echo "<div class=\"row\" style='margin-top: 50px'>";
                echo "<div class=\"col-md-8 col-md-offset-2\">";
                ?>


                <?php
                if ($num_rows > 0) {


                while ($row = $result->fetch_array()) {
                ?>
                <input type="hidden" name="expid" value="<?php if (isset($expid)) { echo $expid; } ?>">


                <?php
                echo "<div class=\"col-md-6\" style='height: 40px;'>Experiment No.: " . $row['id'] . "</div>";


                echo "<div class=\"col-md-6\" style='height: 40px;'>Experiment Name: " . $row['name'] . "</div>";
                echo "<div class=\"col-md-12\" style='height: 40px;'>Description: " . $row['description'] . "</div>";

                $eaostaff1 = $row['eao1'];
                $eaostaff2 = $row['eao2'];
$currenteaostaff=0;
                ?>

                <?php
                if ($eaoid == $eaostaff1) {
                    $currenteaostaff=1;
                    ?>

                    <input type="hidden" name="isvalideao1" value="<?php echo $currenteaostaff ?>">

                    <div class="col-md-2">Comments:</div>


                    <input type="text" name="eaofirstcommnets" value="test1">

                    </input>

                    <?php
                } else {
                    $currenteaostaff=2;
                    ?>


                    <input type="hidden" name="isvalideao1" value="<?php echo $currenteaostaff ?>">
                    <div class="col-md-2">Comments:</div>

                    <input type="text" name="eao2commnets" value="test2">
                    </input>

                    <?php

                }
                ?>

                <div class="form-group">
                    <input type="submit" name="addcomments" value="Add commnents" class="btn btn-primary"/>
                </div>
            </form>
            <?php
            /* echo "<div class=\"col-md-6\" style='height: 40px;'>EAO 1: " . $row['eao1'] . "</div>";
             echo "<div class=\"col-md-6\" style='height: 40px;border-right: solid 1px #2a6496'>EAO 2: " . $row['eao2'] . "</div>";*/
        }


            $result->close();

        }
        else {

            ?>
            <script language="JavaScript">
                alert("no data ");

            </script>
            <?php
        }
        }
    }

}



include_once 'footer.php';
?>