<?php

if(isset($_GET['sid'])){
     $gsid = $_GET['sid'];
}

if (isset($_POST['bookseat'])) {
    header("Location: ../chooselib.php?sid=".$gsid);
    exit();
}
else if(isset($_POST['viewbook'])){
    header("Location: ../viewbook.php".$gsid);
    exit();
}
else if(isset($_POST['viewbook'])){
    header("Location: ../index.php");
    exit();
}