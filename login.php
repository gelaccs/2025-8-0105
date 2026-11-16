<?php
include "config.php";

$message = "";
$success = "";

// galing sa register.php pag successful ang sign up
if (isset($_GET["registered"])) {
    $success = "Account created! You can now log in.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // hanapin ang user sa database
    $stmt = mysqli_prepare($conn, "SELECT id, fullname, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // i-check kung tama ang password
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];

        // i-save kung kailan nag-log in (para makita sa admin)
        $update = mysqli_prepare($conn, "UPDATE users SET last_login = NOW(), last_activity = NOW() WHERE id = ?");
        mysqli_stmt_bind_param($update, "i", $user["id"]);
        mysqli_stmt_execute($update);

        header("Location: home.html");
        exit();
    } else {
        $message = "Wrong username or password.";
    }
}
?>
<!DOCTYPE html>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelacso Travel & Tours</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <section class = "section1">
    <header class="hero">

        <nav>

            <div class="logo">

                <img src="gelacso.png">

                <h2>
                    GELACSO TRAVEL & TOURS
                </h2>

            </div>


        </nav>



        <main>

             <section class="login-page">

            <div class="login-box">

                
                   <h1>LOG IN HERE</h1>

                <?php if ($success != "") { ?>
                    <p style="margin-bottom: 10px; padding: 10px; border-radius: 5px; background: rgba(31, 143, 95, 0.85);"><?php echo $success; ?></p>
                <?php } ?>

                <?php if ($message != "") { ?>
                    <p style="margin-bottom: 10px; padding: 10px; border-radius: 5px; background: rgba(192, 80, 77, 0.85);"><?php echo $message; ?></p>
                <?php } ?>

             
               

                <form action="login.php" method="post">

                  
                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required>
                

                    <button type="submit">LOG IN</button>

                </form>

                <a class="back-home" href="index.html">
                    BACK
                </a>

            </div>

        </section>

        </main>

    </header>
</section>

    <footer>

        <p>
            @ 2026 Gelacso Travel & Tours. All Rights Reserved.
        </p>

    </footer>

</body>

</html>
