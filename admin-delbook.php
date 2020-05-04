<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    $gsid = $_SESSION['sid'];   // Get sid from SESSION
    if($gsid!="admin"){
        //If the page is not accessed by admin, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    ob_start();     //Enable output buffering
    require 'includes/bls.dbh.php'; // Include the database connection script file

    if (isset($_POST['login-submit'])) {

        // Get sid, password and book id from POST.
        $usid = $_POST['sid'];
        $password = $_POST['pwd'];
        $bid = $_POST['delbook'];
      
        // Check whether there exist empty input or not.
        if (empty($usid) || empty($password)|| empty($bid)) {
          header("Location: ../bls/admin-delbook.php?error=empty");   //If any field is empty, show an error message to notice the user.
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
            header("Location: ../bls/admin-delbook.php?error=sqlerror");
            exit();
          }
          else {
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
              // If the password is incorrect, we produce a error message.
              if ($pwdCheck == false){           
                // If the password is incorrect, we add error id "wrongpwd" into the url
                header("Location: ../bls/admin-delbook.php?error=wrongpwd");
                exit();
              }
                else if ($pwdCheck == true){    // If password is correct, we continue and execute the codes below
                    // We check whether the bookid inputted by the user exists or not, and whether it is booked by the user.
                    $checkseatsql = "SELECT * FROM bookrecord WHERE bookid=?";
                    if(mysqli_stmt_prepare($stmt, $checkseatsql)){
                        mysqli_stmt_bind_param($stmt, "i", $bid);
                        mysqli_stmt_execute($stmt);
                        $checkseatresult = mysqli_stmt_get_result($stmt);
                    }   else{
                        // If the bookid is invalid (The bookid doesn't exist or the bookid is refers to the booking by other users)
                        // We add error id into the url link, and then an error message will be printed
                        header("Location: ../bls/admin-delbook.php?error=1");
                    }

                    if($row = mysqli_fetch_assoc($checkseatresult)) {
                        session_start();
                        $_SESSION['sid'] = $row['sid'];
                        // Delete the book record selected by admin
                        $updsql = "DELETE FROM `bookrecord` WHERE bookid=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (mysqli_stmt_prepare($stmt, $updsql)){
                            mysqli_stmt_bind_param($stmt, "s", $bid);
                            mysqli_stmt_execute($stmt);
                        }
                        // After delected the record, it returns to the same webpage, but the booking record shown is updated.
                        header("Location: ../bls/admin-delbook.php");
                        exit();
                    }
                    else {
                        // If the bookid is invalid, We add error id into the url link, and then an error message will be printed
                        header("Location: ../bls/admin-delbook.php?error=1");
                    }
                    
              }
            }
            else {
                // If the SID is not found in the database, the action is failed, and an error id is added to the url
              header("Location: ../bls/admin-delbook.php?error=siderror");
              exit();
            }
          }
        }
        // Then we close the prepared statement and the database connection
         mysqli_stmt_close($stmt);
      }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
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
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
   
    <?php
        // Here, we check whether the url contains "error" or not   
        if(isset($_GET['error'])){
            // If there exist error, we can get the 'error' code into the value $errorCheck for our convenience.
            $errorCheck = $_GET['error'];
            if($errorCheck == "empty"){
                // If there is empty input, we print an error message to notify the user to fill in all the fields
                echo '<h1 style="font-size:28px;color:red;text-align:center;font-family:arial;">Please fill in all the fields!</h1>';
            }
            else if($errorCheck == "wrongpwd"){
                // If the password is wrong, we print an error message to notify him/her
                echo '<h1 style="font-size:28px;color:red;text-align:center;font-family:arial;">The password is incorrect!</h1>';
            }
            else if($errorCheck == "siderror"){
                // If the sid does not exist in account database, we we print an error message to notify him/her
                echo '<h1 style="font-size:28px;color:red;text-align:center;font-family:arial;">Student/staff id invalid!</h1>';
            }
            else{
                // If the book id is invalid, we print an error message to notify him/her
                echo '<h1 style="font-size:28px;color:red;text-align:center;font-family:arial;">Book ID invalid!</h1>';
            }
        }
        echo '<p class="chooselib">
            My booking record
            </p>';
         $gsid = $_SESSION['sid'];  //Get the user's sid from SESSION
         // Select the booking records from databse.
         $selsql = "SELECT * FROM bookrecord WHERE 1 ORDER BY bookdate ASC";
         $stmt = mysqli_stmt_init($conn);
         // We use prepared statement to access and get data from database.
         if(mysqli_stmt_prepare($stmt, $selsql)){
            // mysqli_stmt_bind_param($stmt, "s", $gsid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } 
         mysqli_stmt_close($stmt);
         if(!mysqli_num_rows($result)) {
             // If there is no book record found, we notify the admin about that.
             echo "<p align='center' style='color:red;font-size:22px;font-family:arial;font-weight:bold;'>
             You haven't booked any seat<br>";
         }
         else {
             // output data of each row
             echo '<table style="width:66%">
             <tr>
                 <th>SID</th>
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
                // $getfloorsql = "SELECT `floor` FROM `areainfo` WHERE `area`='".$row['area']."'";
                // In here, we also get the floor of each book area, from the areainfo table. and then show it to user.
                $getfloorsql = "SELECT `floor` FROM `areainfo` WHERE `area`='".$row['area']."' AND `lib`='".$row['lib']."'";
                $getfloorresult = mysqli_query($conn, $getfloorsql);
                $getfloorrow = mysqli_fetch_array($getfloorresult);

                 echo "<tr>";
                 echo "<td>".$row['sid']."</td>";
                 $library=$row['lib'];
                 echo "<td>".$row['bookid']."</td>";
                 // Here, we convert the library id to the full name of the libraries.
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
                 // We print the floor, area, seat id, book date, start time, end time to the table.
                 echo "<td>".$getfloorrow['floor']."/F</td>
                 <td>".$row['area']."</td>
                 <td>".$row['seatid']."</td>
                 <td>".$row['bookdate']."</td>
                 <td>".$row['starttime']."</td>
                 <td>".$row['endtime']."</td>
             </tr>";
             }
             echo "</table><br>";
             // We add a field to allow the user to input the book id that he/she wants to cancel
            echo '<form action="" method="POST">';
            echo '<p align="center" class="ques">Please insert the <font color="red">book ID</font> that you want to cancel</p>
            <input type="text" id="delbook" name="delbook" style="width:400px;"><br>';
            // We add a login filed to let the user to login again, so as to confirm the booking.
            echo '<p align="center" style="font-size:20px;" class="ques">Please login again to confirm.</p><br>';
                    if(isset($_SESSION['sid'])){
        // If the sid already exist in SESSION, it will be inputted into the sid field automatically, so that the user can just input the password.
                        $psid = $_SESSION['sid'];
                        echo '<input type="text" name="sid" placeholder="Student/Staff ID" style="width:400px;" value="'.$psid.'"><br>';
                    }
                    else{
                        echo '<input type="text" name="sid" placeholder="Student/Staff ID" style="width:400px;"><br>';
                    }
            echo '<input type="password" name="pwd" placeholder="Password" style="width:400px;">
                <br>
                <button type="submit" name="login-submit">Confirm</button>
            </form>';
        }
        // Here, we provide a button for the user to check the floor plan of library. We also provide a button for the user to return homepage
        echo '<form method="post">
                <button name="home">Return to homepage</button>
            </form>';
        if(isset($_POST['home'])){
            // If the button "Return to homepage" is clicked, it returns to the home page.
            $_SESSION['sid']="admin";
            header("Location: ../bls/admin_home.php");
            exit();
        }
        ob_end_flush();
    ?>

</body>

</html>