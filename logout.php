<?php
include "config.php";

// burahin ang session tapos balik sa landing page
session_unset();
session_destroy();

header("Location: index.html");
exit();
?>
