<?php

session_start();
include_once 'header.php';
include_once 'dbconnect.php';
//set validation error flag as false
$error = false;
$expid = 0;
$num_rows=0;

if (isset($_GET["expid"])) {

    $expid = $_GET["expid"];


}else{
    $expid =0;
}

if(isset($_SESSION['usr_id'])) {
    //
    if ($_SESSION['usr_role'] == "admin") {

        if (isset($_POST['submit'])) {
            $firstaeo = $_POST['eao1'];
            $secondaeo = $_POST['eao2'];
            $expid = $_POST['expid'];

            if( $firstaeo == $secondaeo){
            ?>

            <script language="JavaScript">
                alert("Selected AEOs should be different!");
                header("Location: admin_experimentmanager.php");

            </script>
            <?php
        }

        else
        {
            //update experiment table with eaos data

            //UPDATE `experiments` SET `eao1`=[value-4],`eao2`=[value-5],`studentid`=[value-6] WHERE 1
            //UPDATE `experiments` SET `eao1`='yasri',`eao2`='hfgf' WHERE 6
            //UPDATE `experiments` SET `eao1`=1,`eao2`=2 WHERE 6
            $updatequery=mysqli_query($con,"Update experiments set eao1='$firstaeo',eao2='$secondaeo' where id='$expid'");

           // $updatequery = mysqli_query("UPDATE experiments SET eao1=" . 1 .",eao2=" . 2 . " WHERE id=". 6, $con);

            if($updatequery){
                ?>

                <script language="JavaScript">
                    alert("Updated!");
                    header("Location: admin_experimentmanager.php");

                </script>
                <?php
            } else {
                ?>
                <script language="JavaScript">
                    alert("DB error!");
                    header("Location: admin_experimentmanager.php");

                </script>
                <?php
            }
        }
        }
        else
            {
        $eoarole = "eao";
        //getting experiment details
        $result = mysqli_query($con, "SELECT * FROM users where userrole LIKE '%eao%' ");
        $result2 = mysqli_query($con, "SELECT * FROM users where userrole LIKE '%eao%' ");

        $num_rows = mysqli_num_rows($result);
        ?>
          <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="assigneaoform" >
         <input type="hidden" name="expid" value="<?php echo $expid?>">;
        <?php
        echo "<div class=\"row\" style='margin-top: 100px'>";
        echo "<h1 class=\"col-md-8 col-md-offset-2\" style='text-align: center'> Assignment of EAOs </h1>";
        echo "</div>";
        echo "<div class=\"row\" style='margin-top: 50px'>";
        echo "<div class=\"col-md-8 col-md-offset-2\">";

        //if we have EAOs
        if ($num_rows > 0) {

            $experimentrecords = mysqli_query($con, "SELECT * FROM experiments where id=" .$expid);


            while ($row = $experimentrecords->fetch_array()) {

                echo "<div  >Experiment No.:&nbsp;&nbsp; " . $row['id'] . "</div>";
                echo "<div  >Experiment Name:&nbsp;&nbsp; " . $row['name'] . "</div>";
                echo "<div >Description: &nbsp;&nbsp;" . $row['description'] . "</div>";

                echo "<div >SelectEAO 1:&nbsp;&nbsp;";

                // . $row['eao1'] .
                echo "<select name=eao1 value=''>EAO 1 name</option>"; // list box select command

                while ($eao1 = $result->fetch_array()) {

                    echo "<option value=$eao1[id]>$eao1[name]</option>";

                }

                echo "</select>";// Closing of list box


                echo "<div >Select EAO 2:&nbsp;&nbsp;";

// . $row['eao1'] .
                echo "<select name=eao2 value=''>EAO 2 name</option>"; // list box select command

                while ($eao2 = $result2->fetch_array()) {

                    echo "<option value=$eao2[id]>$eao2[name]</option>";

                }

                echo "</select>";// Closing of list box


            }

            $result->close();
            $experimentrecords->close();
            ?>
<br/>
 <input type="submit" name="submit" value="Update" class="btn btn-primary" />
          </form>
 <?php
        }
        else {
            ?>
            <script language="JavaScript">

                alert("Number of registered EAOs should be alteast 2!");


            </script>
            <?php

        }
    }
    }


}

include_once 'footer.php';
?>