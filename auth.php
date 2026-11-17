<?php
// para sa customer pages: dapat naka-log in at hindi admin
include "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
    header("Location: admin.html");
    exit();
}

// i-save na active pa ang user
mysqli_query($conn, "UPDATE users SET last_activity = NOW() WHERE id = " . $_SESSION["user_id"]);
?>
