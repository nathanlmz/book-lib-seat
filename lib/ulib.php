<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    <p class="chooselib">
        University Library
        <br>
    </p>
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        echo '<form method="post">
            <button name="second">2nd Floor</button>
            <button name="third">3rd Floor</button>
            <button name="forth">4th Floor</button>
            <button name="return">Return to previous page</button>
        </form>';
        if (isset($_POST['second'])) {
            header("Location: ../lib/ulib/secondfloor.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['third'])){
            header("Location: ../lib/ulib/thirdfloor.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['forth'])){
            header("Location: ../lib/ulib/forthfloor.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['return'])){
            header("Location: ../home.php?sid=".$gsid);
            exit();
        }
    ?>
</body>

</html>