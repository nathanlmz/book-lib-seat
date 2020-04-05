
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Book Lib Seat</title>
        <link rel="stylesheet" href="stylesheets/login.style.css">   <!-- Include the stylesheet -->
    </head>

    <body>
        <!-- The layout of login page -->
        <h1 class="title">Book Lib Seat</h1>
        <br>
        <form action="includes/booklibseatlogin.php" method="POST">
            <?php
                if(isset($_GET['sid'])){
                    $first = $_GET['sid'];
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID  eg. s1155xxxxxx" value="'.$first.'"><br>';
                }
                else{
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID  eg. s1155xxxxxx"><br>';
                }
            ?>

            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="login-submit">Log in</button>
        </form>

        <?php
        //    Check password correct or not, and give relevant message
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