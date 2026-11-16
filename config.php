<?php
// PHP CONFIGURATION - connection sa MySQL database (XAMPP)

$db_host = "localhost";
$db_user = "root";       // default user ng XAMPP
$db_pass = "";           // default walang password sa XAMPP
$db_name = "gelacso_db"; // pangalan ng database
$db_port = 3307;         // port ng MySQL ng XAMPP (3307 kasi may ibang MySQL sa 3306)

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
