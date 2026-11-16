<?php
include "config.php";

$message = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST["fullname"]);
    $email    = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm_password"];

    if ($fullname == "" || $email == "" || $username == "" || $password == "") {
        $message = "Please fill out all fields.";
    } else if ($password != $confirm) {
        $message = "Passwords do not match.";
    } else {

        // check kung may gumagamit na ng username o email
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? OR email = ?");
        mysqli_stmt_bind_param($check, "ss", $username, $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $message = "Username or email is already taken.";
        } else {

            // i-hash ang password bago i-save
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_prepare($conn, "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert, "ssss", $fullname, $email, $username, $hashed);

            if (mysqli_stmt_execute($insert)) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }
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

             <section class="register-page">

            <div class="register-box">

                <h1>SIGN UP HERE</h1>

                <?php if ($success != "") { ?>
                    <p style="margin-bottom: 10px; padding: 10px; border-radius: 5px; background: rgba(31, 143, 95, 0.85);"><?php echo $success; ?></p>
                <?php } ?>

                <?php if ($message != "") { ?>
                    <p style="margin-bottom: 10px; padding: 10px; border-radius: 5px; background: rgba(192, 80, 77, 0.85);"><?php echo $message; ?></p>
                <?php } ?>


                <form action="register.php" method="post">

                    <input type="text" name="fullname" placeholder="Full Name" required>

                    <input type="email" name="email" placeholder="Email address" required>
                    <input type="text" name="username" placeholder="Username" required>

                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirm_password" placeholder="Confirm password" required>

                    <button type="submit">SIGN UP</button>

                       <p class="already-account">
                        Already have an account?
                        <a href="login.php">SIGN IN HERE</a>
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
