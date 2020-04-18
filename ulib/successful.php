<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../index.php");
        exit();
    }
     $gsid = $_SESSION['sid'];
    require 'bls.dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.78">
    <style>
         button:hover {background-color:#4B0082}
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <p align="center">
        <font face="arial" color="green" size="6"><b>BOOK SUCCESSFUL!</b></font>
        <br><br>
    </p>
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        echo '<form method="post">
                <button name="homepage">Return Homepage</button>
                <button name="viewbook">View my bookings</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['homepage'])) {
            header("Location: ../home.php");
            exit();
        }
        else if(isset($_POST['viewbook'])){
            header("Location: ../viewbook.php");
            exit();
        }
        else if(isset($_POST['logout'])){
            session_unset();
            session_destroy(); 
            header("Location: ../index.php");
            exit();
        }
    ?>
</body>

</html>