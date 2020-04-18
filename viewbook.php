<?php
    session_start();
    if(!isset($_SESSION['sid'])){
        //If there is no sid on url, return to the login page.
        header("Location: ../bls/index.php");
        exit();
    }
    $gsid = $_SESSION['sid'];
    ob_start();
    require 'includes/bls.dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Lib Seat</title>
    <link rel="stylesheet" href="stylesheets/home.style.css">
    <meta name="viewport" content="width=device-width, initial-scale=0.78">
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
        button:hover {background-color:#4B0082}
    </style>
</head>

<body>
    <header><h1 class="title">Book Lib Seat</h1></header>
   
    <p class="chooselib">
        My booking record
    </p>
    <?php
         $gsid = $_SESSION['sid'];
         $selsql = "SELECT bookdate, starttime, endtime, lib, area, seatid FROM bookrecord WHERE sid='".$gsid."' AND bookdate>=CURRENT_DATE() ORDER BY bookdate ASC";
         $result = mysqli_query($conn, $selsql);

         if(!mysqli_num_rows($result)) {
             echo "<p align='center'>You haven't booked any seat<br>";
         }
         else {
             // output data of each row
             echo '<table style="width:65%">
             <tr>
                 <th>Library</th>
                 <th>Floor</th>
                 <th>Area</th>
                 <th>Seat id</th>
                 <th>date</th>
                 <th>From</th>
                 <th>To</th>
             </tr>'; 
             while($row = mysqli_fetch_assoc($result)) {
                 // echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
                $getfloorsql = "SELECT `floor` FROM `areainfo` WHERE `area`='".$row['area']."' AND `lib`='".$row['lib']."'";
                $getfloorresult = mysqli_query($conn, $getfloorsql);
                $getfloorrow = mysqli_fetch_array($getfloorresult);
                 
                 echo "<tr>";
                 $library=$row['lib'];
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
                 echo "
                 <td>".$getfloorrow['floor']."/F</td>
                 <td>".$row['area']."</td>
                 <td>".$row['seatid']."</td>
                 <td>".$row['bookdate']."</td>
                 <td>".$row['starttime']."</td>
                 <td>".$row['endtime']."</td>
             </tr>";
             }
             echo "</table><br>";
         }
        // We include the codes of the buttons in php because we want to keep the sid
        echo '<form method="post">
                <button name="delbook">Cancel a booking</button>
                <button name="floorplan">View Library Floorplan</button>
                <button name="home">Return to homepage</button>
            </form>';
        // if(isset($_POST['viewbook'])){
        //     header("Location: ../bls/viewbook.php?sid=".$gsid);
        //     exit();
        // }
        if(isset($_POST['delbook'])){
            header("Location: ../bls/delbook.php");
            exit();
        }
        else if(isset($_POST['home'])){
            header("Location: ../bls/home.php");
            exit();
        }
        else if(isset($_POST['floorplan'])){
            header("Location: ../bls/floorplan.php");
            exit();
        }
        ob_end_flush();
    ?>

</body>

</html>