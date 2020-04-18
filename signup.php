<?php
  // To make sure we don't need to create the header section of the website on multiple pages, we instead create the header HTML markup in a separate file which we then attach to the top of every HTML page on our website. In this way if we need to make a small change to our header we just need to do it in one place. This is a VERY cool feature in PHP!
  
?>
<html>
<head>
<link rel="stylesheet" href="stylesheets/login.style.css">
</head>
    <body>
      <div class="wrapper-main">
        <section class="section-default">
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
          else if (isset($_GET["signup"])) {
            if ($_GET["signup"] == "success") {
              echo '<p class="success">Signup successful!</p>';
            }
          }
          ?>
          <form class="form-signup" action="includes/signup.inc.php" method="post">
            <?php
            // Here we check if the user already tried submitting data.

            // We check username.
            if (!empty($_GET["sid"])) {
              echo '<input type="text" name="sid" placeholder="Username" value="'.$_GET["sid"].'"><br>';
            }
            else {
              echo '<input type="text" name="sid" placeholder="Username"><br>';
            }

            // We check e-mail.
            if (!empty($_GET["mail"])) {
              echo '<input type="text" name="mail" placeholder="E-mail" value="'.$_GET["mail"].'"><br>';
            }
            else {
              echo '<input type="text" name="mail" placeholder="E-mail"><br>';
            }
            ?>
            <input type="password" name="pwd" placeholder="Password"><br>
            <input type="password" name="pwd-repeat" placeholder="Repeat password"><br>
            <input type="password" name="admpwd" placeholder="Admin password"><br>
            <button type="submit" name="signup-submit">Signup</button><br>
          </form>
        </section>
      </div>
    </body>

</html>