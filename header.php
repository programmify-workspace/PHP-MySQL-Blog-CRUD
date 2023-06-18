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
    <script src="./script.js"></script>
</head>
<body>
<header>
    <div class="blog-logo-name">
        <div class="blog-logo-container">
            <img src="./assets/techtype-logo.png" alt="">
        </div>
        <h1 class="blog-name" ><a href="home.php">Techtype</a></h1>
    </div>
    <nav class="blog-nav">
        <div class="blog-nav-menu">
            <li class="sub-nav-menu"><a href="home.php">Home</a></li>
            <li class="sub-nav-menu"><a href="home.php">About</a></li>
            <li class="sub-nav-menu"><a href="home.php">Contact us</a></li>
            <li class="sub-nav-menu"><i class="fa-regular fa-pen-to-square"></i><a href="write-post.php">Write</a></li>
        </div>
        <div class="blog-nav-login-profile">
            <?php if (isset($_SESSION["user"])) : ?>
            <li>
                <a href="profile.php" style="display: flex; gap: 10px;">
                    <p><?php echo ucwords($username) ?>'s account</p>
                    <div class="profile-pic">
                        <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                    </div>
                </a>
            </li>
            <li class="login-registerbtn"><a href="logout.php">Sign out</a></li>
            <?php else : ?>
            <li class="login-registerbtn"><a href="login.php">Login</a></li>
            <li class="login-registerbtn"><a href="register.php">Sign up</a></li>
            <?php endif; ?>
        </div>
    </nav>
    
     <div class="hamburger" onclick="toggleBlogMenu()">
        <i class="fa-solid fa-bars hamburger"></i>
     </div>   
    
    <div id="blog-menu">
        <li class="sub-nav-menu"><a href="home.php">Home</a></li>
        <li class="sub-nav-menu"><a href="home.php">About</a></li>
        <li class="sub-nav-menu"><a href="home.php">Contact us</a></li>
        <li class="sub-nav-menu"><i class="fa-regular fa-pen-to-square"></i><a href="write-post.php">Write</a></li>
        <?php if (isset($_SESSION["user"])) : ?>
        <li>
            <a href="profile.php" style="display: flex; gap: 10px;">
                <p><?php echo ucwords($username) ?>'s account</p>
                <div class="profile-pic">
                    <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                </div>
            </a>
        </li>
        <li class="login-registerbtn" ><a href="logout.php">Sign out</a></li>
        <?php else : ?>
        <li class="login-registerbtn"><a href="login.php">Login</a></li>
        <li class="login-registerbtn"><a href="register.php">Sign up</a></li>
        <?php endif; ?>
    </div>
    
</header>