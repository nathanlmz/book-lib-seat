<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
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
        echo '<form method="post">';
        if ($_SESSION['sid']=="admin"){
            echo '<button name="signup">Add new accounts</button>';
        }
        echo   '<button name="bookseat">Book a seat</button>
                <button name="viewbook">View my bookings</button>
                <button name="floorplan">View Library Floorplan</button>
                <button name="delbook">Cancel a booking</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['bookseat'])) {
            header("Location: ../bls/ulib.php");
            exit();
        }
        else if(isset($_POST['signup'])&&$gsid=="admin"){
            header("Location: ../bls/signup.php");
            exit();
        }
        else if(isset($_POST['viewbook'])){
            header("Location: ../bls/viewbook.php");
            exit();
        }
        else if(isset($_POST['floorplan'])){
            header("Location: ../bls/floorplan.php");
            exit();
        }
        else if(isset($_POST['delbook'])){
            header("Location: ../bls/delbook.php");
            exit();
        }
        else if(isset($_POST['logout'])){
            session_unset();
            session_destroy(); 
            mysqli_close($conn);
            header("Location: ../bls/index.php");
            exit();
        }
    ?>

</body>

</html>