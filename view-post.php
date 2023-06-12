<?php
session_start();
include("php/config.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the blog post from the database
    $select_sql = "SELECT * FROM blog_posts WHERE id = ?";
    $select_stmt = mysqli_prepare($conn, $select_sql);
    mysqli_stmt_bind_param($select_stmt, "i", $id);
    mysqli_stmt_execute($select_stmt);
    $select_result = mysqli_stmt_get_result($select_stmt);

    if ($select_result) {
        $post = mysqli_fetch_assoc($select_result);

        // Check if the blog post exists
        if (!$post) {
            echo "Blog post not found.";
            exit();
        }
    } else {
        echo "Failed to retrieve the blog post.";
        exit();
    }
} else {
    echo "Invalid blog post ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?></title>
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
                <?php
                $username = $_SESSION["username"];
                ?>
                <li>
                    <a href="profile.php" style="display: flex; gap: 10px;" class="sub-nav-menu">
                        <p><?php echo $username ?>'s account</p>
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
</header>

<section class="full-post">
    <div style="margin:auto;">
        <img src="<?php echo $post['image']; ?>" width="500px" alt="">
    </div>
    <h1 class="post-title title" style="color: var(--scantyColor);"><?php echo $post['title']; ?></h1>
    <div class="post-content"><?php echo '<p>' . $post['content'] . '</p>'; ?></div>
</section>