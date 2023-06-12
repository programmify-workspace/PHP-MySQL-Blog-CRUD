<?php
    include("php/config.php");

    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
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
    <header>
        <div class="blog-logo-name">
            <div class="blog-logo-container">
                <img src="./assets/techtype-logo.png" alt="">
            </div>
            <h1 class="blog-name">Techtype</h1>
        </div>
        <nav class="blog-nav">
            <div class="blog-nav-menu">
                <li class="sub-nav-menu">Home</li>
                <li class="sub-nav-menu">About</li>
                <li class="sub-nav-menu">Contact Us</li>
                <li class="sub-nav-menu"><i class="fa-regular fa-pen-to-square"></i> Write</li>
            </div>
            <div class="blog-nav-login-profile">
                <li class="login-registerbtn"><a href="">Login</a></li>
                <li class="login-registerbtn"><a href="">Sign up</a></li>
                <!-- <li style="display: flex; gap: 10px;">
                    <p>Hello Guest</p>
                    <div class="profile-pic">
                        <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                    </div>
                </li> -->
            </div>
            
        </nav>
    </header>
</body>
</html>