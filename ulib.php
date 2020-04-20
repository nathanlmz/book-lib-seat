<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
     $gsid = $_SESSION['sid'];

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
    else if(isset($_POST['ccsecond'])){
        header("Location: ../bls/ulib/ccsecondfloor.php");
        exit();
    }
    else if(isset($_POST['ccfirst'])){
        header("Location: ../bls/ulib/ccfirstfloor.php");
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
    
    <?php
    if((!isset($_GET['ulib']))&&(!isset($_GET['uclib']))&&(!isset($_GET['cclib']))){
        echo '<p class="chooselib">
        Please choose a library<br></p>
        <form method="GET">
        <button name="ulib">University Library</button>
        <button name="uclib">United College Library</button>
        <button name="cclib">Chung Chi College Library</button>
    </form>';
    echo '<form method="POST"><button name="home">Return to home page</button></form>';
    }

    else if (isset($_GET['ulib'])){  
        echo '<p class="chooselib" style="font-size:28px;">
        University Library<br></p>
            <form method="post">
            <button name="second">2nd Floor</button>
            <button name="third">3rd Floor</button>
            <button name="forth">4th Floor</button>
            <button name="return">Return to previous page</button>
        </form>';

    }
    else if(isset($_GET['uclib'])){
        echo '<p class="chooselib" style="font-size:28px;">United College Library</p>
        <form method="post">
        <button name="ucsecond">2nd Floor</button>
        <button name="return">Return to previous page</button>
        </form>';
    }
    else if(isset($_GET['cclib'])){
        echo '<p class="chooselib" style="font-size:28px;">Chung Chi College Library</p>
        <form method="post">
        <button name="ccfirst">1st Floor</button>
        <button name="ccsecond">2nd Floor</button>
        <button name="return">Return to previous page</button>
        </form>';
    }
        
        if(isset($_POST['home'])){
            header("Location: ../bls/home.php");
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../bls/ulib.php");
            exit();
        }
    ?>
</body>

</html>