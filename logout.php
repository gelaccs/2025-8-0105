<?php
include "config.php";

// gawing logged out sa admin list
if (isset($_SESSION["user_id"])) {
    mysqli_query($conn, "UPDATE users SET last_activity = NULL WHERE id = " . $_SESSION["user_id"]);
}

session_destroy();
header("Location: index.html");
exit();
?>
