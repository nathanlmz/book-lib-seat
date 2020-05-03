<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    // Get sid from SESSION
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
    
    <?php
        $gsid = $_SESSION['sid'];   //Get sid
        if((!isset($_GET['ulib']))&&(!isset($_GET['uclib']))&&(!isset($_GET['cclib']))){
            // If the the button "ulib", "uclib" and "cclib" are not clicked, we show these buttons.
            echo '<h1 class="chooselib" style="font-size:36px;color:indigo;">Library Floorplan</h1>';
            echo '<p class="chooselib" style="font-size:24px;">
            Please choose a library
            <br></p>';
            echo '<form method="get" action="">
                <button name="ulib">University Library</button>
                <button name="uclib">United College Library</button>
                <button name="cclib">Chung Chi College Library</button><br>
                <button name="viewbook">View my bookings</button>
            <button name="home">Return to home page</button>
            </form>';
        }
        else if(isset($_GET['ulib'])){
            // If the button 'ulib' is clicked
            if (isset($_POST['second'])) {   //If "2nd Floor" is pressed,
                echo '<p class="chooselib">University Library - 2/F</p>';
                echo '<img src="ulib/ulib_2F.png" class="center">';     // Show the floorplan of the 2nd floor
                echo '<form method="post" action="">
                 <button name="third">3rd Floor</button>
                 <button name="forth">4th Floor</button>
                 </form>';
            }
            else if(isset($_POST['third'])){    //If the button "3rd Floor" is pressed
                echo '<p class="chooselib">University Library - 3/F</p>';
                echo '<img src="ulib/ulib_3F.png" class="center">';     //Show the floorplan of the 3rd floor
                echo '<form method="post" action="">
                 <button name="second">2nd Floor</button>
                 <button name="forth">4th Floor</button>
                 </form>';
            }
            else if(isset($_POST['forth'])){     //If the button "4th Floor" is pressed
                echo '<p class="chooselib">University Library - 4/F</p>';
                echo '<img src="ulib/ulib_4F.png" class="center">';    //Show the floorplan of the 4/F
                echo '<form method="post" action="">
                 <button name="second">2nd Floor</button>
                 <button name="third">3rd Floor</button>
                 </form>';
            }
            else{
                // If the button 'ulib' is clicked, but the buttons of the floors are not clicked, we show the buttons of each floor of the university library.
                echo '<p class="chooselib">
                University Library
                <br></p>';
                echo '<form method="post" action="">
                 <button name="second">2nd Floor</button>
                 <button name="third">3rd Floor</button>
                 <button name="forth">4th Floor</button>
                 </form>';
            }
            
            
        }
        else if(isset($_GET['uclib'])){
            if (isset($_POST['ucsecond'])) {   //If "2nd Floor" is pressed
                echo '<p class="chooselib">United College Library - 2/F</p>';
                echo '<img src="ulib/uclib_2F.png" class="center">';     // Show the floorplan of the 2nd floor
                //exit();
            }
            else{
                // If "2nd floor" is not clicked, we show this button
                echo '<p class="chooselib">
                United College Library
                <br></p>';
                echo '<form method="post" action="">
                <button name="ucsecond">2nd Floor</button></form>';
            }
            
        }
        else if(isset($_GET['cclib'])){
            if (isset($_POST['ccfirst'])) {   //If "1st Floor" is pressed
                echo '<p class="chooselib">Chung Chi College Library - 1/F</p>';
                echo '<img src="ulib/cclib_1F.png" class="center" style="max-height:460px;">';     // Show the floorplan of the 2nd floor
                echo '<form method="post"><button name="ccsecond">2nd Floor</button></form>';
            }
            else if (isset($_POST['ccsecond'])) {   //If "2nd Floor" is pressed
                echo '<p class="chooselib">Chung Chi College Library - 2/F</p>';
                echo '<img src="ulib/cclib_2F.png" class="center">';     // Show the floorplan of the 2nd floor
                echo '<form method="post"><button name="ccfirst">1st Floor</button></form>';
            }
            else{
                // If the button "2nd Floor" and "1st Floor" are not clicked, we show these buttons.
                echo '<p class="chooselib">
                Chung Chi College Library
                <br></p>';
                echo '<form method="post"><button name="ccfirst">1st Floor</button>
                <button name="ccsecond">2nd Floor</button></form>';
            }
        }
        if(isset($_GET['viewbook'])){ //If the button "View my bookings" is pressed
            header("Location: ../bls/viewbook.php"); //Direct to viewbook.php
            exit();
        }
        if(isset($_GET['home'])){     // If the button "Return to home page" is pressed
            header("Location: ../bls/home.php");     //Direct to homepages
            exit();
        }
        if((isset($_GET['ulib']))||(isset($_GET['cclib']))||(isset($_GET['uclib']))){   
            //If any floorplan is shown, we only show the "Return to previous page" button.
            echo '<form method="POST"><button name="return">Return to previous page</button></form>';
            if(isset($_POST['return'])){
                // If the return button is pressed, the webpage is refreshed.
                header("Location: ../bls/floorplan.php");
                exit();
            }
        }
    ?>
</body>

</html>