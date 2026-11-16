<?php
// LOGIN CHECK - isinasama sa taas ng bawat page na kailangan naka-log in
// Kung walang naka-log in, ibabalik sa login page

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
