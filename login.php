<?php
include "config.php";

$message = "";
$success = "";

if (isset($_GET["registered"])) {
    $success = "Account created! You can now log in.";
}

if (isset($_POST["username"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    // pwedeng username o email ang ilagay
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];
        $_SESSION["role"] = $user["role"];

        mysqli_query($conn, "UPDATE users SET last_login = NOW(), last_activity = NOW() WHERE id = " . $user["id"]);

        // admin sa admin page, customer sa home
        if ($user["role"] == "admin") {
            header("Location: admin.html");
        } else {
            header("Location: home.html");
        }
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

                <img src="images/gelacso.png">

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

                  
                    <input type="text" name="username" placeholder="Username or email" required>

                    <input type="password" name="password" placeholder="Password" required>
                

                    <button type="submit">LOG IN</button>

                    <p class="already-account">
                        No account yet?
                        <a href="register.php">SIGN UP HERE</a>
                    </p>

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
