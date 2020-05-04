<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    // Get sid from session
    $gsid = $_SESSION['sid'];
    if($gsid!="admin"){
        //If the page is not accessed by admin, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    ob_start();
    // include the databse connection script
    require 'includes/bls.dbh.php';

    if(isset($_POST['adddaysubmit'])){  // If the close day to be added is submitted
        // Get the date, open time and close time from POST into the 3 corresponding variables
        $addclosedate = $_POST['adddate'];
        $addopentime = $_POST['addopentime'];
        $addclosetime = $_POST['addclosetime'];
        if(empty($addclosedate)){
            // If the date is empty, refresh the page and show an error message.
            header("Location: ../bls/closeday_manage.php?error=emptydate&addcloseday=");
        }
        else if(empty($addopentime)&&empty($addclosetime)){
            // If the open time and close time are both empty, it is considered that the library will be closed for the whole day
            // Access databse to Check whether the day is already a close day.
            $checkselsql = "SELECT `closedate`, `opentime`, `closetime` FROM `closeday` WHERE `closedate`=?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $checkselsql)){
                mysqli_stmt_bind_param($stmt, "s", $addclosedate);
                mysqli_stmt_execute($stmt);
                $checkresult = mysqli_stmt_get_result($stmt);
            }
            mysqli_stmt_close($stmt);
            if(mysqli_num_rows($checkresult)){
                // If the day inputted by the admin is already a close day, refresh the page and show a message to notify him/her
                header("Location: ../bls/closeday_manage.php?error=dateexist&addcloseday=");
            }
            else{
                // If the date is valid, we update it into the database.
                $addopentime = "23:59:59";  //Set the open time to 23:59 if the library closes the whole day
                $addclosetime = "00:00:00"; //Set the close time to 00:00 if the library closes the whole day
                $addsql = "INSERT INTO `closeday`(`closedate`, `opentime`, `closetime`) VALUES (?,?,?)";
                // Access the database using prepared statement
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $addsql)){
                    mysqli_stmt_bind_param($stmt, "sss", $addclosedate,$addopentime,$addclosetime);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
                // After updating the database, refresh the page and then the updated table will be shown.
                header("Location: ../bls/closeday_manage.php?addcloseday=");
                exit();
            }
        }else if(empty($addopentime)){
            // If the open time is empty but the close time is not empty, refresh the page and print an error message
            header("Location: ../bls/closeday_manage.php?error=openempty&addcloseday=");
        }
        else if(empty($addclosetime)){
            // If the close time is empty but the open time is not empty, refresh the page and print an error message
            header("Location: ../bls/closeday_manage.php?error=closeempty&addcloseday=");
        }
        else{
            // Access databse to Check whether the day is already a close day.
            $checkselsql = "SELECT `closedate`, `opentime`, `closetime` FROM `closeday` WHERE `closedate`=?";
            // Access the database using prepared statement
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $checkselsql)){
                mysqli_stmt_bind_param($stmt, "s", $addclosedate);
                mysqli_stmt_execute($stmt);
                $checkresult = mysqli_stmt_get_result($stmt);
            }
            mysqli_stmt_close($stmt);
            if(mysqli_num_rows($checkresult)){
                // If the day inputted by the admin is already a close day, refresh the page and show a message to notify him/her
                header("Location: ../bls/closeday_manage.php?error=dateexist&addcloseday=");
            }
            else{
                // If the date is valid
                // Add a new "close day"(the day with special opening arrangement) into the database with the open time and close time set by the admin
                $addsql = "INSERT INTO `closeday`(`closedate`, `opentime`, `closetime`) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $addsql)){
                    mysqli_stmt_bind_param($stmt, "sss", $addclosedate,$addopentime,$addclosetime);
                    mysqli_stmt_execute($stmt);
                }
                mysqli_stmt_close($stmt);
                // Refresh the page after updating the database, the new updated table will be shown.
                header("Location: ../bls/closeday_manage.php?addcloseday=");
                exit();
            }
        }
    }
    else if(isset($_POST['removedaysubmit'])){
        // If the button "remove a close day" is clicked
        $removedate = $_POST['removedate'];
        // Access the database and delete the close day selected by admin.
        $removesql = "DELETE FROM `closeday` WHERE `closedate`=?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $removesql)){
            mysqli_stmt_bind_param($stmt, "s", $removedate);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        // After deleting the record, refresh the page, and the updated record table will be shown.
        header("Location: ../bls/closeday_manage.php?removecloseday=");
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.78">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            margin-left:auto;
            margin-right:auto;
            
        }
        th, td {
            padding: 5px;
            text-align: center;   
            font-size: 20px;
        }
        .ques{
                text-align: center;
                align-items: center;
                font-size: 20px;
                font-family: arial;
        }
        button:hover {background-color:#4B0082}
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
   <!-- Layout of the webpage -->
   <?php
        // Check whether there exist "error" from the url
        if(isset($_GET['error'])){
            // If there exist error, we print the corresponding error message according to the error id to notify the user.
            if($_GET['error']=="emptydate"){
                echo '<p style="font-size:28px;color:red;font-weight:bold;text-align:center;font-family:Arial;">
                The date is empty!</p>';
            }
            else if($_GET['error']=="openempty"){
                echo '<p style="font-size:28px;color:red;font-weight:bold;text-align:center;font-family:Arial;">
                The open time is missing!</p>';
            }else if($_GET['error']=="closeempty"){
                echo '<p style="font-size:28px;color:red;font-weight:bold;text-align:center;font-family:Arial;">
                The close time is missing!</p>';
            }else if($_GET['error']=="dateexist"){
                echo '<p style="font-size:28px;color:red;font-weight:bold;text-align:center;font-family:Arial;">
                The day you selected is already a close day!</p>';
            }
        }
   ?>
    <p class="chooselib">
        My booking record
    </p>
    <?php
        // Get sid from SESSION
         $gsid = $_SESSION['sid'];
        //  Select the close day record from database
         $selsql = "SELECT * FROM closeday";
        //  Use prepared statement to access the database and get the data.
         $stmt = mysqli_stmt_init($conn);
         if(mysqli_stmt_prepare($stmt, $selsql)){
            // mysqli_stmt_bind_param($stmt, "s", $gsid);       
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } 
        
         if(!mysqli_num_rows($result)) {
            //  If there is no record found in the database, we notify the user(admin) about that.
             echo "<p align='center' style='font-size:22px;font-family:arial;color:green;font-weight:bold;'>
             The library opens for the whole year<br></p>";
         }
         else {
             // output the booking records in a table
             echo '<table style="width:40%">
             <tr>
                 <th>Close date</th>
                 <th>Close time</th>
             </tr>'; 
             while($row = mysqli_fetch_assoc($result)) {
                 echo "<tr>";
                 // Pass the data fetched from database into corresponding variables
                 $closedate=$row['closedate'];
                 $closetime=$row['closetime'];
                 $opentime=$row['opentime'];

                 echo '<td>'.$closedate.'</td>';
                 if($closetime<"08:19:59"){
                     // If the library is already closed before 8:20, we show to the user that the library is closed for whole day
                     echo "<td>Closed for the whole day</td>";
                 }
                 else{
                     // If the library is closed after 8:20, we show the open time and close time of that day.
                    echo "<td>Only opens from ".$opentime." to ".$closetime."</td>";
                 }
                 echo "</tr>";
             }
             echo "</table><br>";
         }
         if(isset($_GET['addcloseday'])){
            // If the button "Add a close day" is clicked, show the input fields for the admin to add a close day and the open time, close time
            echo '
            <form method="post">
            <p align="center" class="ques">The new close day</p>
            <input type="date" id="adddate" name="adddate" placeholder="Date: YYYY-MM-DD">';
            echo '<p align="center" class="ques" style="font-size:18px;">Click "submit" if the library close for whole day
            <br><font color="red">WITHOUT</font> inserting the following fields</p>';
            echo '<p align="center" class="ques">Opening time of that day</p>
            <input type="time" id="addopentime" name="addopentime">
            <p align="center" class="ques">Close time of that day</p>
            <input type="time" id="addclosetime" name="addclosetime">';
            echo '<br><button type="submit" name="adddaysubmit">submit</button>';
            
            echo '</form>';
        }else if(isset($_GET['removecloseday'])){
            // If the button "Remove a close day" is clicked, show an input field for the admin to insert a date, and a "submit" button
            echo '
            <form method="post">
            <p align="center" class="ques">The close day that you want to remove</p>
            <input type="date" id="removedate" name="removedate" placeholder="Date: YYYY-MM-DD">';
            echo '<br><button type="submit" name="removedaysubmit">submit</button>';
            
            echo '</form>';
        }

        
         if(!isset($_GET['addcloseday'])){
            //  If the button "add a close day" is not clicked, show this button
            echo '<form method="GET">';
            echo'<button name="addcloseday">Add a close day</button></form>';
            
        }
        if (!isset($_GET['removecloseday'])){
             //  If the button "remove a close day" is not clicked, show this button
            echo '<form method="GET">';
            echo'<button name="removecloseday">Remove a close day</button></form>';
        }
        

        
        echo '<form method="post"><button name="home">Return to homepage</button></form>';
        if(isset($_POST['home'])){
            // If button "Return to homepage" is clicked, it redirects to the home page.
            header("Location: ../bls/admin_home.php");
            exit();
        }
        ob_end_flush();
    ?>

</body>

</html>