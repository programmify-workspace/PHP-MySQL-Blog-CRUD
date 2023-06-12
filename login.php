<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: home.php");
}
    include('php/config.php');

        if (isset($_POST["submit"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if ($password == $user["password"]) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    $_SESSION["ID"] = $user["ID"];
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["password"] = $user["password"];
                    header("Location: home.php");
                    die();
                }else{
                    $wrong_pass_message = "<p style='display: flex; text-align:center; justify-content:center; color:red;'>Wrong password</p>";
                }
            }else{
                $wrong_email_message = "<p style='display: flex; text-align:center; justify-content:center; color:red;'>Wrong email</p>";
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header style="margin: auto; display: flex; justify-content: center; margin-bottom: 50px;">
            <div class="blog-logo-container">
                <img src="./assets/techtype-logo.png" alt="">
            </div>
            <h1 class="blog-name" ><a href="home.php">Techtype</a></h1>
    </header>

    <section class="form-container">
        <h2 class="form-title">Login</h2>
        
        <form action="login.php" method="POST" >
        <div class="field">
            <label for="email">Email:</label>
            <input class="input" type="email" name="email" id="email" required>
            <?php if(isset($wrong_email_message))
                {echo $wrong_email_message;} ?>
        </div>

        <div class="field">
            <label for="password">Password:</label>
            <input class="input" type="password" name="password" id="password" required>
            <?php if(isset($wrong_pass_message))
                {echo $wrong_pass_message;} ?>
        </div>

        <div class="field">
            <input class="submit" type="submit" name="submit" value="Login" id="submit">
        </div>
            
        </form>
        <p class="form-extra" style="font-size: var(--sfs);">Don't have an account? <a href="register.php" >Sign up here</a></p>
    </section>
</body>
</html>