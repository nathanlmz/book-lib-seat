<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../index.php");
        exit();
    }
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
    <img src="ulib_3F.png" class="center">
    <?php
        echo '<form method="post">
            <button name="area_b">Seat area B</button>
            <button name="area_c">Seat area C</button>
            <button name="area_d">Seat area D</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['area_b'])) {
            $_SESSION['lib'] = "ulib";
            header("Location: ../ulib/bookulib.php?area=B");
            exit();
        }
        else if (isset($_POST['area_c'])) {
            $_SESSION['lib'] = "ulib";
            header("Location: ../ulib/bookulib.php?area=C");
            exit();
        }
        else if (isset($_POST['area_d'])) {
            $_SESSION['lib'] = "ulib";
            header("Location: ../ulib/bookulib.php?area=D");
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../ulib.php?ulib=");
            exit();
        }
    ?>
</body>

</html>