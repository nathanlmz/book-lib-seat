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
    <p class="chooselib" style="font-size:24px;">
        University Library
        <br>
    </p>
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        
        echo '<form method="post">
            <button name="second">2nd Floor</button>
            <button name="third">3rd Floor</button>
            <button name="forth">4th Floor</button>
        </form>
        
        <p class="chooselib" style="font-size:24px;">United College Library</p>
        <form method="post">
        <button name="ucsecond">2nd Floor</button>
        <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['second'])) {
            header("Location: ../bls/ulib/secondfloor.php");
            exit();
        }
        else if(isset($_POST['third'])){
            header("Location: ../bls/ulib/thirdfloor.php");
            exit();
        }
        else if(isset($_POST['forth'])){
            header("Location: ../bls/ulib/forthfloor.php");
            exit();
        }
        else if(isset($_POST['ucsecond'])){
            header("Location: ../bls/ulib/UCsecondfloor.php");
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../bls/home.php");
            exit();
        }
    ?>
</body>

</html>