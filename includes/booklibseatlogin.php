<?php
// Here we check whether the user got to this page by clicking the login button.
if (isset($_POST['login-submit'])) {
  // Include the database connection script file
  require 'bls.dbh.php';
  // Get sid and password for chekcing.
  $usid = $_POST['sid'];
  $password = $_POST['pwd'];

  // Check whether there exist empty input or not.
  if (empty($usid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields&sid=".$usid);
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
      header("Location: ../index.php?error=sqlerror");
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
        if ($pwdCheck == false){
          header("Location: ../index.php?error=wrongpwd");
          exit();
        }
          else if ($pwdCheck == true){
          session_start();
          // Create the session variables.
          $_SESSION['sid'] = $row['sid'];

          if($_SESSION['sid']=="admin"){  //If the 'sid' is "admin", we go to the admin home page
            header("Location: ../admin_home.php");
          }
          else{ //If the 'sid' is not "admin", we go to the normal homepage
            header("Location: ../home.php");
            exit();
          }
            
        }
      }
      else {  // If the sid inputted by user is not found in database, we display an error message to show that the account doesn't exist
        header("Location: ../index.php?error=sidinvalid");
        exit();
      }
    }
  }
  // Then we close the prepared statement and the database connection!
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  // If the user tries to access this page in an inproper way, we send them back to the login page
  header("Location: ../index.php");
  exit();
}
