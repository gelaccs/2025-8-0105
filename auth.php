<?php
// LOGIN CHECK - isinasama sa taas ng bawat page na kailangan naka-log in
// Kung walang naka-log in, ibabalik sa login page

include_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// i-save na active pa ang user (para makita sa admin)
$active = mysqli_prepare($conn, "UPDATE users SET last_activity = NOW() WHERE id = ?");
mysqli_stmt_bind_param($active, "i", $_SESSION["user_id"]);
mysqli_stmt_execute($active);
?>
