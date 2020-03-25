
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Book Lib Seat</title>
        <link rel="stylesheet" href="stylesheets/login.style.css">
    </head>

    <body>
        <h1 class="title">Book Lib Seat</h1>
        <br>
        <form action="includes/booklibseatlogin.php" method="POST">
            <?php
                if(isset($_GET['sid'])){
                    $first = $_GET['sid'];
                    echo '<input type="text" name="sid" placeholder=" Student/Staff ID" value="'.$first.'"><br>';
                }
                else{
                    echo '<input type="text" name="sid" placeholder=" Student/Staff ID"><br>';
                }

                /*
                if(isset($_GET['last'])){
                    $last = $_GET['last'];
                    echo '<input type="text" name="last" placeholder="Last name" value="'.$last.'"><br>';
                }
                else{
                    echo '<input type="text" name="last" placeholder="Last name"><br>';
                }

                if(isset($_GET['email'])){
                    $email = $_GET['email'];
                    echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'"><br>';
                }
                else{
                    echo '<input type="text" name="email" placeholder="E-mail"><br>';
                }

                if(isset($_GET['uid'])){
                    $uid = $_GET['uid'];
                    echo '<input type="text" name="uid" placeholder="Username" value="'.$uid.'"><br>';
                }
                else{
                    echo '<input type="text" name="uid" placeholder="Username"><br>';
                }
                */
            ?>
            <!--<input type="text" name="first" placeholder="First name">
            <br>
            //<input type="text" name="last" placeholder="Last name">
            <br>
            <input type="text" name="email" placeholder="E-mail">
            <br>
            <input type="text" name="uid" placeholder="Username">
            <br> -->
            <!--<input type="text" name="sid" placeholder=" Student/Staff ID">
            <br> -->
            <input type="password" name="pwd" placeholder=" Password">
            <br>
            <button type="submit" name="login-submit">Log in</button>
        </form>

        <?php
            /*
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($fullUrl,"signup=empty") == true){
                echo "<p class='error'>You did not fill in all fields!</p>";
                exit();
            }
            elseif(strpos($fullUrl,"signup=char") == true){
                echo "<p class='error'>You used invalid characters!</p>";
                exit();
            }
            elseif(strpos($fullUrl,"signup=invalidemail") == true){
                echo "<p class='error'>You used an invalid e-mail!</p>";
                exit();
            }
            elseif(strpos($fullUrl,"signup=success") == true){
                echo "<p class='success'>You have been signed up!</p>";
                exit();
            }
            */

            /////////////////////////////////////////
            if(!isset($_GET['error'])){
                exit();
            }
            else{
                $errorCheck = $_GET['error'];

                if($errorCheck == "emptyfields"){
                    echo "<p class='error'>You did not fill in all fields!</p>";
                    exit();
                }
                elseif($errorCheck == "sqlerror"){
                    echo "<p class='error'>Connection failed!</p>";
                    exit();
                }
                elseif($errorCheck =="wrongpwd"){
                    echo "<p class='error'>The password is wrong!</p>";
                    exit();
                }
                elseif($errorCheck == "wronguidpwd"){
                    echo "<p class='error'>Student/staff id doesn't exist!</p>";
                    exit();
                }
            }
        ?>
        


    </body>
</html>