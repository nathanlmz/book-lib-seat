<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
    
    <?php
    // We include the codes of the buttons in php because we want to keep the sid
        $gsid = $_GET['sid'];
        if((!isset($_POST['second']))&&(!isset($_POST['third']))&&(!isset($_POST['forth']))){
            echo '<p class="chooselib">
            Floor plan of the University Library
            <br></p>';
            echo '<form method="post" action="">
                <button name="second">2nd Floor</button>
                <button name="third">3rd Floor</button>
                <button name="forth">4th Floor</button>
                <button name="viewbook">View my bookings</button>
            <button name="home">Return to home page</button>
            </form>';
        
        }
        if (isset($_POST['second'])) {
            echo '<p class="chooselib">University Library - 2/F</p>';
            echo '<img src="lib/ulib/ulib_2F.png" class="center" height="562" width="914">';
            //exit();
        }
        else if(isset($_POST['third'])){
            echo '<p class="chooselib">University Library - 3/F</p>';
            echo '<img src="lib/ulib/ulib_3F.png" class="center" height="562" width="914">';
            //exit();
        }
        else if(isset($_POST['forth'])){
            echo '<p class="chooselib">University Library - 4/F</p>';
            echo '<img src="lib/ulib/ulib_4F.png" class="center" height="562" width="914">';
            //exit();
        }
        else if(isset($_POST['viewbook'])){
            header("Location: ../bls/viewbook.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['home'])){
            header("Location: ../bls/home.php?sid=".$gsid);
            exit();
        }
        if((isset($_POST['second']))||(isset($_POST['third']))||(isset($_POST['forth']))){
            echo '<form method="POST"><button name="return">Return to previous page</button></form>';
            if(isset($_POST['return'])){
                header("Location: ../bls/floorplan.php?sid=".$gsid);
                exit();
            }
        }
        
    ?>
</body>

</html>