<?php
// Here we check whether the user got to this page by clicking the proper login button.
if (isset($_POST['login-submit'])) {

  // Include the database connection script file
  require 'bls.dbh.php';

  // Grab sid and password for chekcing.
  $usid = $_POST['sid'];
  $password = $_POST['pwd'];

  // Check whether there exist empty input or not.
  if (empty($usid) || empty($password)) {
    header("Location: ../bookulib.php?error=emptyfields&sid=".$usid);
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
      header("Location: ../bookulib.php?error=sqlerror");
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
        if ($password !== $row['pwd']){            //Here, the password in database is still not encripted, so we just compare the password from database and the one inputted by the user
          // If there is an error we send the user back to the signup page.
          header("Location: ../bookulib.php?error=wrongpwd");
          exit();
        }
        //else if ($pwdCheck == true) {
          else if ($password == $row['pwd']){      //Here, the password in database is still not encripted, so we just compare the password from database and the one inputted by the user

          session_start();
          // Create the session variables.
          $_SESSION['sid'] = $row['sid'];
          //header("Location: ../bookulib.php?login=success");
          header("Location: ../home.php?sid=".$usid);
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=wronguidpwd");
        exit();
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page an inproper way, we send them back to the signup page.
  header("Location: ../signup.php");
  exit();
}
