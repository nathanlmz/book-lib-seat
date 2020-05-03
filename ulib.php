<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
     $gsid = $_SESSION['sid'];

     if (isset($_POST['second'])) {
         // If the button "2nd Floor" of ulib is pressed, it jumps to ulib/secondfloor.php
        header("Location: ../bls/ulib/secondfloor.php");
        exit();
    }
    else if(isset($_POST['third'])){
        // If the button "3rd Floor" of ulib is pressed, it jumps to ulib/thirdfloor.php
        header("Location: ../bls/ulib/thirdfloor.php");
        exit();
    }
    else if(isset($_POST['forth'])){
        // If the button "4th Floor" of ulib is pressed, it jumps to ulib/forthfloor.php
        header("Location: ../bls/ulib/forthfloor.php");
        exit();
    }
    
    else if(isset($_POST['ucsecond'])){
        // If the button "2nd Floor" of uclib is pressed, it jumps to UCsecondfloor.php
        header("Location: ../bls/ulib/UCsecondfloor.php");
        exit();
    }
    else if(isset($_POST['ccsecond'])){
        // If the button "2nd Floor" of cclib is pressed, it jumps to ccsecondfloor.php
        header("Location: ../bls/ulib/ccsecondfloor.php");
        exit();
    }
    else if(isset($_POST['ccfirst'])){
        // If the button "1st Floor" of cclib is pressed, it jumps to ccfirstfloor.php
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
         // If the button 'ulib', 'uclib' or 'cclib' are not pressed, we show these buttons to user
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
        // If the button 'ulib' is pressed, we show the buttons of each floor of ulib, as well as the button to return homepage
        echo '<p class="chooselib">
        University Library<br></p>
            <form method="post">
            <button name="second">2nd Floor</button>
            <button name="third">3rd Floor</button>
            <button name="forth">4th Floor</button>
            <button name="return">Return to previous page</button>
        </form>';

    }
    else if(isset($_GET['uclib'])){
        // If the button 'uclib' is pressed, we show the buttons of each floor of uclib, as well as the button to return homepage
        echo '<p class="chooselib">United College Library</p>
        <form method="post">
        <button name="ucsecond">2nd Floor</button>
        <button name="return">Return to previous page</button>
        </form>';
    }
    else if(isset($_GET['cclib'])){
        // If the button 'cclib' is pressed, we show the buttons of each floor of cclib, as well as the button to return homepage
        echo '<p class="chooselib">Chung Chi College Library</p>
        <form method="post">
        <button name="ccfirst">1st Floor</button>
        <button name="ccsecond">2nd Floor</button>
        <button name="return">Return to previous page</button>
        </form>';
    }
        
        if(isset($_POST['home'])){
            // If the button 'home' is pressed, it jumps to the home page.
            header("Location: ../bls/home.php");
            exit();
        }
        else if(isset($_POST['return'])){
            // If the button 'return' is pressed, it jumps to the previous page.
            header("Location: ../bls/ulib.php");
            exit();
        }
    ?>
</body>

</html>