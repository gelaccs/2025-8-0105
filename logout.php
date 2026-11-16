<?php
include "config.php";

// i-mark na naka-log out na sa database
if (isset($_SESSION["user_id"])) {
    $out = mysqli_prepare($conn, "UPDATE users SET last_activity = NULL WHERE id = ?");
    mysqli_stmt_bind_param($out, "i", $_SESSION["user_id"]);
    mysqli_stmt_execute($out);
}

// burahin ang session tapos balik sa landing page
session_unset();
session_destroy();

header("Location: index.html");
exit();
?>
