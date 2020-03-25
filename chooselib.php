<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <?php
        /*
        if(!isset($_GET['sid'])){
            exit();
        }
        else{
            $sid = $_GET['sid'];
            echo "<p class='chooselib'>Hello ".$sid."!</p>";
        }
        */
    ?>
    <p class="chooselib">
        Please choose a library
        <br>
    </p>
    <!--<form method="post">
        <button name="ulib">University Library</button>
        <button name="nalib">New Asia College Library</button>
        <button name="cclib">Chung Chi College Library</button>
        <button name="uclib">United College Library</button>
    </form> -->

    <?php
        $gsid = $_GET['sid'];
        echo '<form method="post">
            <button name="ulib">University Library</button>
            <button name="nalib">New Asia College Library</button>
            <button name="cclib">Chung Chi College Library</button>
            <button name="uclib">United College Library</button>
            <button name="home">Return to previous page</button>
        </form>';
        if (isset($_POST['ulib'])) {
            header("Location: ../bls/lib/ulib.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['nalib'])){
            header("Location: ../bls/lib/nalib.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['cclib'])){
            header("Location: ../bls/lib/cclib.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['uclib'])){
            header("Location: ../bls/lib/uclib.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['home'])){
            header("Location: ../bls/home.php?sid=".$gsid);
            exit();
        }
    ?>
</body>

</html>