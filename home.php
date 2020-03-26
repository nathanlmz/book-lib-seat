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
            echo "<p class='chooselib'>".$sid."</p>";
        }
        */
    ?>
    <p class="chooselib">
        I want to
    </p>
    
    <?php
        // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        echo '<form method="post">
                <button name="bookseat">Book a seat</button>
                <button name="viewbook">View my bookings</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['bookseat'])) {
            header("Location: ../bls/chooselib.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['viewbook'])){
            header("Location: ../bls/viewbook.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['logout'])){
            header("Location: ../bls/index.php");
            exit();
        }
    ?>

</body>

</html>