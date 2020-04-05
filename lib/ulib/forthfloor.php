<?php
    require 'bls.dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <?php
    // This codes are just for printing out User's sid, but we don't want to do that by now.
        /*
        if(!isset($_GET['sid'])){
            exit();
        }
        else{
            $sid = $_GET['sid'];
            echo "<p class='chooselib'>Hello ".$sid."!</p>";
        }
        */
    ?>
    <p class="chooselib">
        Please choose an bookable seat area
        <br>
    </p>
    <img src="ulib_4F.png" class="center" height="562" width="914">
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        echo '<form method="post">
            <button name="area_e">Seat area E</button>
            <button name="area_f">Seat area F</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['area_e'])) {
            header("Location: ../ulib/bookulib.php?sid=".$gsid."&area=E");
            exit();
        }
        else if (isset($_POST['area_f'])) {
            header("Location: ../ulib/bookulib.php?sid=".$gsid."&area=F");
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../ulib.php?sid=".$gsid);
            exit();
        }
    ?>
</body>

</html>