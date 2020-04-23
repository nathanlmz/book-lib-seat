<?php
session_start();
if(isset($_POST['return'])){
  header("Location: ../home.php");
}
else if (isset($_POST['signup-submit'])) {

  // Include database connection script
  require 'bls.dbh.php';
  // Grab all the data which we passed from the signup form so we can use it later.
  $sid = $_POST['sid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];
  $admpwd = $_POST['admpwd'];

  // Then we perform a bit of error handling to make sure we catch any errors made by the user. Here you can add ANY error checks you might think of! I'm just checking for a few common errors in this tutorial so feel free to add more. If we do run into an error we need to stop the rest of the script from running, and take the user back to the signup page with an error message. As an additional feature we will also send all the data back to the signup page, to make sure all the fields aren't empty and the user won't need to type it all in again.

  // We check for any empty inputs. (PS: This is where most people get errors because of typos! Check that your code is identical to mine. Including missing parenthesis!)
  if (empty($sid) || empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../signup.php?error=emptyfields&sid=".$sid."&mail=".$email);
    exit();
  }
  // We check for an invalid username AND invalid e-mail.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $sid) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invaliduidmail");
    exit();
  }
  // We check for an invalid username. In this case ONLY letters and numbers.
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $sid)) {
    header("Location: ../signup.php?error=invaliduid&mail=".$email);
    exit();
  }
  // We check for an invalid e-mail.
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../signup.php?error=invalidmail&sid=".$sid);
    exit();
  }
  // We check if the repeated password is NOT the same.
  else if ($password !== $passwordRepeat) {
    header("Location: ../signup.php?error=passwordcheck&sid=".$sid."&mail=".$email);
    exit();
  }
  else {
    // First we create the statement that searches our database table to check for any identical usernames.
    $sql = "SELECT 'sid' FROM accounts WHERE sid=?;";
    // We create a prepared statement.
    $stmt = mysqli_stmt_init($conn);
    // Then we prepare our SQL statement AND check if there are any errors with it.
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      // If there is an error we send the user back to the signup page.
      header("Location: ../signup.php?error=sqlerror1");
      exit();
    }
    else {
      // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
      mysqli_stmt_bind_param($stmt, "s", $sid);
      // Then we execute the prepared statement and send it to the database!
      mysqli_stmt_execute($stmt);
      // Then we store the result from the statement.
      mysqli_stmt_store_result($stmt);
      // Then we get the number of result we received from our statement. This tells us whether the username already exists or not!
      $resultCount = mysqli_stmt_num_rows($stmt);
      // Then we close the prepared statement!
      mysqli_stmt_close($stmt);
      // Here we check if the username exists.
      if ($resultCount > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {
        // fetch the admin's password from the account database
        $admsql = "SELECT * FROM accounts WHERE sid='admin';";
        $admresult = mysqli_query($conn, $admsql);
        $admrow = mysqli_fetch_assoc($admresult);


        $admpwdCheck = password_verify($admpwd, $admrow['pwd']);
        if($admpwdCheck == true){
          // if the admin's password is correct, the following account info are inserted into the database
          $sql = "INSERT INTO accounts (`sid`, `linkmail`, `pwd`) VALUES (?, ?, ?);";
          // Here we initialize a new statement using the connection from the dbh.inc.php file.
          $stmt = mysqli_stmt_init($conn);
          // Then we prepare our SQL statement AND check if there are any errors with it.
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            // If there is an error we send the user back to the signup page.
            header("Location: ../signup.php?error=sqlerror2");
            exit();
          }
          else {
            // For data safety, we hash the password before inserting the account into the databse
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            // Next we need to bind the type of parameters we expect to pass into the statement, and bind the data from the user.
            mysqli_stmt_bind_param($stmt, "sss", $sid, $email, $hashedPwd);
            // Execute the prepared statement and send it to the database
            mysqli_stmt_execute($stmt);
            // Lastly we send the user back to the signup page with a success message!
            header("Location: ../signup.php?signup=success");
            exit();
          }
        }
        else if ($admpwdCheck == false){
          // If the admin's password is incorrect, an error message displayed, and signup failed
          header("Location: ../signup.php?error=admpwderror");
          exit();
        }
      }
    }
  }
  // Close the prepared statement and the database connection
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If someone tries to access this page an inproper way, we send them back to the signup page.
  header("Location: ../index.php");
  exit();
}
