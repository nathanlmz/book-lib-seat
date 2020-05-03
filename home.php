<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    // Get user's SID from SESSION.
     $gsid = $_SESSION['sid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <style>
        button:hover {background-color:#4B0082}
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <p class="chooselib">
        I want to
    </p>
    
    <?php
        // We include the codes of the buttons in php because we want to keep the sid
        // Show the buttons required for the homepage.
        echo '<form method="post">';
        echo   '<button name="bookseat">Book a seat</button>
                <button name="viewbook">View my bookings</button>
                <button name="floorplan">View Library Floorplan</button>
                <button name="delbook">Cancel a booking</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['bookseat'])) {
            // If the button "Book a seat" is pressed, we direct it to ulib.php which is the first page required to book a seat.
            header("Location: ../bls/ulib.php");
            exit();
        }
        else if(isset($_POST['viewbook'])){
            // If the button "View my bookings" is pressed, it will be directed to viewbook.php.
            header("Location: ../bls/viewbook.php");
            exit();
        }
        else if(isset($_POST['floorplan'])){
            // If the button "View Libray Floorplan" is pressed, it will be directed to floorplan.php.
            header("Location: ../bls/floorplan.php");
            exit();
        }
        else if(isset($_POST['delbook'])){
            // If the button "Cancel a booking" is pressed, it will be directed to delbook.php.
            header("Location: ../bls/delbook.php");
            exit();
        }
        else if(isset($_POST['logout'])){
            // If the button "Log out" is pressed, the session value will be cleared, and the connection to database will be closed,
            // And then it jumps to the login page.
            session_unset();
            session_destroy(); 
            mysqli_close($conn);
            header("Location: ../bls/index.php");
            exit();
        }
    ?>

</body>

</html>