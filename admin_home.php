<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    // Get user's SID from SESSION.
     $gsid = $_SESSION['sid'];
     if($gsid!="admin"){
        //If the page is not accessed by admin, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
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
        if ($_SESSION['sid']=="admin"){
            echo '<button name="signup">Add new accounts</button>';
        }
        echo   '<button name="closeday">Manage open and close day</button>
                <button name="viewbook">View booking records</button>
                <button name="delbook">Cancel a booking</button>
                <button name="logout">Log out</button>
            </form>';
        if (isset($_POST['closeday'])) {
            // if the button "Manage open and close day", redirect to closeday_manage.php
            header("Location: ../bls/closeday_manage.php");
            exit();
        }
        else if(isset($_POST['signup'])&&$gsid=="admin"){
            // if the button "Add new accounts" is pressed, redirect to signup.php
            header("Location: ../bls/signup.php");
            exit();
        }
        else if(isset($_POST['viewbook'])){
            // if the button "View booking records" is pressed, redirect to admin-viewbook.php
            header("Location: ../bls/admin-viewbook.php");
            exit();
        }
        else if(isset($_POST['delbook'])){
            // if the button "Cancel a booking" is pressed, redirect to admin-delbook.php
            header("Location: ../bls/admin-delbook.php");
            exit();
        }
        else if(isset($_POST['logout'])){
            // if the button "Log out" is pressed, unset and destroy the session, disconnect with database, redirect to log in page. 
            session_unset();
            session_destroy(); 
            mysqli_close($conn);
            header("Location: ../bls/index.php");
            exit();
        }
    ?>

</body>

</html>