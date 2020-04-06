<?php
    ob_start();
    require 'includes/bls.dbh.php';

    if (isset($_POST['login-submit'])) {

        // Include the database connection script file
        require 'includes/bls.dbh.php';
      
        // Grab sid and password for chekcing.
        $usid = $_POST['sid'];
        $password = $_POST['pwd'];
        $bid = $_POST['delbook'];
      
        // Check whether there exist empty input or not.
        if (empty($usid) || empty($password)) {
          header("Location: ../bls/delbook.php?error=emptyfields&sid=".$usid);
          exit();
        }
        else {
          // Select the data from the account database which has the same sid as the user input
          $sql = "SELECT * FROM accounts WHERE sid=?;";
          // Initialize a new statement using the connection from the dbh.inc.php file.
          $stmt = mysqli_stmt_init($conn);
          // Then we prepare our SQL statement AND check if there are any errors with it.
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            // If there is an error we send the user back to the signup page.
            header("Location: ../bls/delbook.php?error=sqlerror&sid=".$usid);
            exit();
          }
          else {
      
            // If there is no error then we continue here.
      
            // Bind the type of parameters we expect to pass into the statement, and bind the data from the user.
            mysqli_stmt_bind_param($stmt, "s", $usid);
            // Execute the prepared statement and send it to the database
            mysqli_stmt_execute($stmt);
            // Get the result from the statement.
            $result = mysqli_stmt_get_result($stmt);
            // Store the result into a variable.
            if ($row = mysqli_fetch_assoc($result)) {
              // Match the password from the database with the password submitted by user. The result is returned to variable $pwdCheck
              $pwdCheck = password_verify($password, $row['pwd']);
              // If they don't match then we create an error message!
              //if ($pwdCheck == false) {
              if ($pwdCheck == false){            //Here, the password in database is still not encripted, so we just compare the password from database and the one inputted by the user
                // If there is an error we send the user back to the signup page.
                header("Location: ../bls/delbook.php?error=wrongpwd&sid=".$usid);
                exit();
              }
              //else if ($pwdCheck == true) {
                else if ($pwdCheck == true){      //Here, the password in database is still not encripted, so we just compare the password from database and the one inputted by the user
                    $checkseatsql = "SELECT * FROM bookrecord WHERE bookid='".$bid."' AND sid='".$usid."'";
                    $checkseatresult = mysqli_query($conn, $checkseatsql);

                    if((mysqli_num_rows($checkseatresult))) {
                        session_start();
                        // Create the session variables.
                        $_SESSION['sid'] = $row['sid'];
                        $updsql = "DELETE FROM `bookrecord` WHERE bookid='".$bid."' AND sid='".$usid."'";
                        $stmt = mysqli_stmt_init($conn);
                        if (mysqli_stmt_prepare($stmt, $updsql)){
                            // mysqli_stmt_bind_param($stmt, "sssssss", $usid, $date, $starttime, $endtime, $seat);
                            mysqli_stmt_execute($stmt);
                        }
                        //header("Location: ../bls/delbooksuccessful.php?sid=".$usid);
                        header("Location: ../bls/delbook.php?sid=".$usid);
                        exit();
                    }
                    else if(!mysqli_num_rows($checkseatresult)){
                        header("Location: ../bls/delbook.php?error=1&sid=".$usid);
                    }
              }
            }
            else {
              header("Location: ../index.php?error=wronguidpwd");
              exit();
            }
          }
        }
        // Then we close the prepared statement and the database connection!
        // mysqli_stmt_close($stmt);
        // mysqli_close($conn);
      }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
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
        .ques{
                text-align: center;
                align-items: center;
                font-size: 20px;
                font-family: arial;
        }
        .bs{
                display: block;
                width: 404px;
                height: 45px;
                margin: auto;
                border-color: purple;
                border-width: 1px;
                border-radius: 4px;
                font-family: Arial;
                color: black;
                font-weight: bold;
                font-size: 16px;
                text-align: left;
                padding-left: 10px;
        }
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
   
    <?php
        if(isset($_GET['error'])){
            echo '<h1 style="font-size:28px;color:red;text-align:center;font-family:arial;">Book ID invalid!</h1>';
        }
        echo '<p class="chooselib">
            My booking record
            </p>';
         $gsid = $_GET['sid'];
         $selsql = "SELECT bookid, bookdate, starttime, endtime, lib, area, seatid FROM bookrecord WHERE sid='".$gsid."' AND bookdate>=CURRENT_DATE() ORDER BY bookdate ASC";
         $result = mysqli_query($conn, $selsql);

         if(!mysqli_num_rows($result)) {
             echo "<p align='center'>You haven't booked any seat<br>";
         }
         else {
             // output data of each row
             echo '<table style="width:66%">
             <tr>
                 <th>Book ID</th>
                 <th>Library</th>
                 <th>Floor</th>
                 <th>Area</th>
                 <th>Seat id</th>
                 <th>date</th>
                 <th>From</th>
                 <th>To</th>
             </tr>'; 
             while($row = mysqli_fetch_assoc($result)) {
                $getfloorsql = "SELECT `floor` FROM `areainfo` WHERE `area`='".$row['area']."'";
                $getfloorresult = mysqli_query($conn, $getfloorsql);
                $getfloorrow = mysqli_fetch_array($getfloorresult);

                 echo "<tr>";
                 $library=$row['lib'];
                 echo "<td>".$row['bookid']."</td>";
                 if($library=="ulib"){
                     echo "<td>University Library</td>";
                 }
                 else{
                    echo "<td>".$row['lib']."</td>";
                 }
                 echo "<td>".$getfloorrow['floor']."/F</td>
                 <td>".$row['area']."</td>
                 <td>".$row['seatid']."</td>
                 <td>".$row['bookdate']."</td>
                 <td>".$row['starttime']."</td>
                 <td>".$row['endtime']."</td>
             </tr>";
             }
             echo "</table><br>";
         }
        
        echo '<form action="" method="POST">';
        // echo '<p align="center" style="font-size:20px;">Which seat do you want to choose?</p>
        // <input type="text" id="seat" name="seat" class="bs" placeholder="'.$area.'1-'.$area.'20"><br>';
        echo '<p align="center" class="ques">Please insert the book ID that you want to cancel</p>
        <input type="text" id="delbook" name="delbook" clss="bs" style="width:404px;"><br>';
        echo '<p align="center" style="font-size:20px;" class="ques">Please login again to confirm.</p><br>';
                if(isset($_GET['sid'])){
                    $first = $_GET['sid'];
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID" value="'.$first.'" class="bs"><br>';
                }
                else{
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID" class="bs"><br>';
                }
        echo '<input type="password" name="pwd" placeholder="Password" class="bs">
            <br>
            <button type="submit" name="login-submit" style="width:416px">Confirm</button>
        </form>';
        // We include the codes of the buttons in php because we want to keep the sid
        echo '<form method="post">
                <button name="floorplan" style="width:416px">View Library Floorplan</button>
                <button name="home" style="width:416px">Return to homepage</button>
            </form>';
        if(isset($_POST['home'])){
            header("Location: ../bls/home.php?sid=".$gsid);
            exit();
        }
        else if(isset($_POST['floorplan'])){
            header("Location: ../bls/floorplan.php?sid=".$gsid);
            exit();
        }
        ob_end_flush();
    ?>

</body>

</html>