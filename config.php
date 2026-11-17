<?php
// connection sa database (XAMPP, MySQL port 3307)
$conn = mysqli_connect("localhost", "root", "", "gelacso_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
?>
