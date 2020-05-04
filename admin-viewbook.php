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
        }
        button:hover {background-color:#4B0082}
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
   <!-- Layout of the webpage -->
    <p class="chooselib">
        My booking record
    </p>
    <?php
        // Get sid from SESSION
         $gsid = $_SESSION['sid'];
        //  Select the booking record from database
         $selsql = "SELECT * FROM bookrecord WHERE 1 ORDER BY bookdate ASC";
        //  Use prepared statement to access the database and get the data.
         $stmt = mysqli_stmt_init($conn);
         if(mysqli_stmt_prepare($stmt, $selsql)){
            // mysqli_stmt_bind_param($stmt, "s", $gsid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } 
        
         if(!mysqli_num_rows($result)) {
            //  If there is no book record found in the database we notify the user(admin) about that.
             echo "<p align='center' style='font-size:22px;font-family:arial;color:red;font-weight:bold;'>
             Booking record is empty<br></p>";
         }
         else {
             // output the booking record in a table, if there exist booking records
             echo '<table style="width:65%">
             <tr>
                 <th>SID</th>
                 <th>Library</th>
                 <th>Floor</th>
                 <th>Area</th>
                 <th>Seat id</th>
                 <th>date</th>
                 <th>From</th>
                 <th>To</th>
             </tr>'; 
             while($row = mysqli_fetch_assoc($result)) {
                // If there are booking record fetched.
                // Get the floor of the bookable seat area from database using prepared statement.
                $getfloorsql = "SELECT `floor` FROM `areainfo` WHERE `area`=? AND `lib`=?";
                
                $stmt = mysqli_stmt_init($conn);
                if(mysqli_stmt_prepare($stmt, $getfloorsql)){
                   mysqli_stmt_bind_param($stmt, "ss", $row['area'], $row['lib']);
                   mysqli_stmt_execute($stmt);
                   $getfloorresult = mysqli_stmt_get_result($stmt);
               } 
                // Load the floor info fetched from database into $getfloorrow
                $getfloorrow = mysqli_fetch_array($getfloorresult);
                mysqli_stmt_close($stmt);
                 echo "<tr>";
                 echo "<td>".$row['sid']."</td>";
                 $library=$row['lib'];
                 // Translate and print the lib id (ulib, uclib, cclib) into the full name of library.
                 if($library=="ulib"){
                     echo "<td>University Library</td>";
                 }
                 else if($library=="uclib"){
                    echo "<td>United College Library</td>";
                }
                else if($library=="cclib"){
                    echo "<td>Chung Chi College Library</td>";
                }
                 else{
                    echo "<td>".$row['lib']."</td>";
                 }
                 // Show the information of each booking record into the table.
                 echo "
                 <td>".$getfloorrow['floor']."/F</td>
                 <td>".$row['area']."</td>
                 <td>".$row['seatid']."</td>
                 <td>".$row['bookdate']."</td>
                 <td>".$row['starttime']."</td>
                 <td>".$row['endtime']."</td>
             </tr>";
             }
             echo "</table><br>";
         }
        echo '<form method="post">';
        if(mysqli_num_rows($result)){
            // If there exist booking records, we add a button for him/her to redirect to "cancel booking" page.
           echo'<button name="delbook">Cancel a booking</button>';
        }
        // Add a button for returning to home page.
        echo'<button name="home">Return to homepage</button>
        </form>';
        if(isset($_POST['delbook'])){
            // If button "Cancel a booking" is clicked, it redirects to delbook.php
            header("Location: ../bls/admin-delbook.php");
            exit();
        }
        else if(isset($_POST['home'])){
            // If button "Return to homepage" is clicked, it redirects to the home page.
            header("Location: ../bls/admin_home.php");
            exit();
        }
        ob_end_flush();
    ?>

</body>

</html>