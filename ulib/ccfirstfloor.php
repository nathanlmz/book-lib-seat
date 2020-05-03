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
    <img src="cclib_1F.png" class="center" style="max-height:460px;">
    <?php
        // Show the following buttons.
        echo '<form method="post">
            <button name="area_a">Seat area A</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['area_a'])) {
            // If the button "Seat area A" is pressed, get the library id of cclib into SESSION.
            $_SESSION['lib'] = "cclib";
            // Redirect to bookulib.php, pass area=A to the url
            header("Location: ../ulib/bookulib.php?area=A");
            exit();
        }
        else if(isset($_POST['return'])){
            // If "Return to previous page" button is clicked, redirect to ulib.php with the library id
            header("Location: ../ulib.php?cclib=");
            exit();
        }
    ?>
</body>

</html>