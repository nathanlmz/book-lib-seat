<?php
// If there exist an sid in the header, we get it into $gsid
if(isset($_GET['sid'])){
     $gsid = $_GET['sid'];
}

// If the user clicks the "bookseat" button, it jumps to chooselib.php page
if (isset($_POST['bookseat'])) {
    header("Location: ../chooselib.php?sid=".$gsid);
    exit();
}
// If the user clicks the "view booking" button, it jumps to viewbook.php page
else if(isset($_POST['viewbook'])){
    header("Location: ../viewbook.php".$gsid);
    exit();
}

else if(isset($_POST['viewbook'])){
    header("Location: ../index.php");
    exit();
}