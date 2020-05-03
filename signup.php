<?php
  // To make sure we don't need to create the header section of the website on multiple pages, we instead create the header HTML markup in a separate file which we then attach to the top of every HTML page on our website. In this way if we need to make a small change to our header we just need to do it in one place. This is a VERY cool feature in PHP!
  
  if(isset($_POST['return'])){
    header("Location ../bls/home.php");
  }
        
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="stylesheets/login.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
form input{
  width:314px;
  height: 32px;
}
</style>
</head>
    <body>
    <h1 class="title">Book Lib Seat</h1>
      <?php
      // Here we create an error message if the user made an error trying to sign up.
      if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyfields") {
          echo '<p class="error">Fill in all fields!</p>';
        }
        else if ($_GET["error"] == "invaliduidmail") {
          echo '<p class="error">Invalid username and e-mail!</p>';
        }
        else if ($_GET["error"] == "invaliduid") {
          echo '<p class="error">Invalid username!</p>';
        }
        else if ($_GET["error"] == "invalidmail") {
          echo '<p class="error">Invalid e-mail!</p>';
        }
        else if ($_GET["error"] == "passwordcheck") {
          echo '<p class="error">Your passwords do not match!</p>';
        }
        else if ($_GET["error"] == "usertaken") {
          echo '<p class="error">Username is already taken!</p>';
        }
        else if ($_GET["error"] == "admpwderror") {
          echo '<p class="error">Admin password incorrect!</p>';
        }
        
      }
      // Here we create a success message if the new user was created.
      // else if (isset($_GET["signup"])) {
      //   if ($_GET["signup"] == "success") {
      //     echo '<p class="success">Signup successful!</p>';
      //   }
      // }
      ?>
      <form action="includes/signup.inc.php" method="post">
        <?php
        // Here, we check whethet there exist 'sid' from the url or not
        if (!empty($_GET["sid"])) {
          // If there exist 'sid' from the url, we show a 'sid' field with the sid contained.
          echo '<input type="text" name="sid" placeholder="Username" value="'.$_GET["sid"].'"><br>';
        }
        else {
          // If there doesn't exist 'sid' from the url, we just show a 'sid' input field without sid contained.
          echo '<input type="text" name="sid" placeholder="Username"><br>';
        }

        if (!empty($_GET["mail"])) {
          //  If there exist 'email' from the url, we show a 'email' field with the email contained.
          echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'"><br>';
        }
        else {
          // If there doesn't exist 'email' from the url, we just show a 'email' input field without email contained.
          echo '<input type="text" name="mail" placeholder="E-mail"><br>';
        }
        ?>
        <input type="password" name="pwd" placeholder="Password"><br>
        <input type="password" name="pwd-repeat" placeholder="Repeat password"><br>
        <input type="password" name="admpwd" placeholder="Admin password"><br>
        <button type="submit" name="signup-submit">Signup</button>
        <button type="submit" name="return">Return to previous page</button>
      </form>
        
    </body>

</html>