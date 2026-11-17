<?php
include "config.php";

$message = "";
$success = "";

if (isset($_POST["username"])) {
    $fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email    = mysqli_real_escape_string($conn, $_POST["email"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $confirm  = $_POST["confirm_password"];

    // check kung may gumagamit na ng username o email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");

    if ($password != $confirm) {
        $message = "Passwords do not match.";
    } else if (mysqli_num_rows($check) > 0) {
        $message = "Username or email is already taken.";
    } else {
        // naka-hash ang password bago i-save
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$username', '$hashed')");

        header("Location: login.php?registered=1");
        exit();
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
