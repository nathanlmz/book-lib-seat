<?php
    require 'includes/bls.dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <p align="center">
        <font face="arial" color="green" size="6"><b>The Booking is CANCELLED!</b></font>
        <br><br>
    </p>
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        echo '<form method="post">
                <button name="homepage">Return Homepage</button>
                <button name="viewbook">View my bookings</button>
                <button name="delbook">Cancel another booking</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['homepage'])) {
            header("Location: ../bls/home.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['viewbook'])){
            header("Location: ../bls/viewbook.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['delbook'])){
            header("Location: ../bls/delbook.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['logout'])){
            header("Location: ../bls/index.php");
            exit();
        }
    ?>
</body>

</html>