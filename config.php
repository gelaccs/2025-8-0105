<?php
// PHP CONFIGURATION - connection sa MySQL database (XAMPP)

$db_host = "localhost";
$db_user = "root";       // default user ng XAMPP
$db_pass = "";           // default walang password sa XAMPP
$db_name = "gelacso_db"; // pangalan ng database

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
?>
