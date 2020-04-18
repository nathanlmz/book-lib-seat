<?php
// This php file sets up the database connection to the account database
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "bls";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
