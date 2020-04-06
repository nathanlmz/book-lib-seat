<?php
    if(!isset($_GET['sid'])){
        header("Location: http://localhost/bls/index.php");
        exit();
    }

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
    <img src="ulib_3F.png" class="center" height="562" width="914">
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        echo '<form method="post">
            <button name="area_b">Seat area B</button>
            <button name="area_c">Seat area C</button>
            <button name="area_d">Seat area D</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['area_b'])) {
            header("Location: ../ulib/bookulib.php?sid=".$gsid."&area=B");
            exit();
        }
        else if (isset($_POST['area_c'])) {
            header("Location: ../ulib/bookulib.php?sid=".$gsid."&area=C");
            exit();
        }
        else if (isset($_POST['area_d'])) {
            header("Location: ../ulib/bookulib.php?sid=".$gsid."&area=D");
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../ulib.php?sid=".$gsid);
            exit();
        }
    ?>
</body>

</html>