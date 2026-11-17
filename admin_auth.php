<?php
// para sa admin page: admin lang ang pwede
include "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: home.html");
    exit();
}
?>
