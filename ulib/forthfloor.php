<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../index.php");
        exit();
    }
    // Get the sid from SESSION 
     $gsid = $_SESSION['sid'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            max-height: 562px;
            max-width:100%;
            height: auto;
            width: auto;
        }
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <p class="chooselib">
        Please choose an bookable seat area
        <br>
    </p>
    <img src="ulib_4F.png" class="center">
    <?php
    // Show the buttons
        echo '<form method="post">
            <button name="area_e">Seat area E</button>
            <button name="area_f">Seat area F</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['area_e'])) {
            // If the button "Seat area E" is pressed, pass the library id "ulib" into SESSION['lib']
            $_SESSION['lib'] = "ulib";
            // Redirect to bookulib.php with area id 'F'
            header("Location: ../ulib/bookulib.php?area=E");
            exit();
        }
        else if (isset($_POST['area_f'])) {
             // If the button "Seat area F" is pressed, pass the library id "ulib" into SESSION['lib']
            $_SESSION['lib'] = "ulib";
            // Redirect to bookulib.php with area id 'F'
            header("Location: ../ulib/bookulib.php?area=F");
            exit();
        }
        else if(isset($_POST['return'])){
            // If button "Return to previous page" is clicked, redirect to ulib.php
            header("Location: ../ulib.php?ulib=");
            exit();
        }
    ?>
</body>

</html>