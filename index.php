
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Book Lib Seat</title>
        <link rel="stylesheet" href="stylesheets/login.style.css">   <!-- Include the stylesheet -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            button:hover {background-color:#4B0082}
            form button{
                width:314px;
            }
        </style>
    </head>

    <body>
        <!-- The layout of login page -->
        <h1 class="title">Book Lib Seat</h1>
        <br>
        <form action="includes/booklibseatlogin.php" method="POST">
            <?php
            // If a 'sid' presence in the url, we can pass the 'sid' into the 'sid' field, so that the user can just input the password for login.
                if(isset($_GET['sid'])){
                    $first = $_GET['sid'];
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID  eg. s1155xxxxxx" value="'.$first.'"><br>';
                }
            // If a 'sid' is not present in the url, we also show the 'sid' field for the user to login
                else{
                    echo '<input type="text" name="sid" placeholder="Student/Staff ID  eg. s1155xxxxxx"><br>';
                }
            ?>
            <input type="password" name="pwd" placeholder="Password">
            <br>
            <button type="submit" name="login-submit">Log in</button>
        </form>

        <?php
        //    Check 'error' contains in the url or not, if yes, give relevant message
            if(!isset($_GET['error'])){
                exit();
            }
            else{
                // We get the error id into $errorCheck for furthur use
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
                    echo "<p class='error'>The password is incorrect!</p>";
                    exit();
                }
                elseif($errorCheck == "sidinvalid"){
                    echo "<p class='error'>Student/staff id invalid!</p>";
                    exit();
                }
            }
        ?>
        


    </body>
</html>