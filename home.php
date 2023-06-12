<?php
include("php/config.php");
session_start();

// Check if a user is logged in
if (isset($_SESSION["user"])) {
    $username = $_SESSION["username"];
    $user_id = $_SESSION["ID"];
} else {
    // Set default values for non-logged-in users
    $username = "Guest";
    $user_id = 0;
}

if (isset($_GET["delete"]) && $_SESSION["user"]) {
    $id = $_GET["delete"];

    // Delete the blog post from the database
    $delete_sql = "DELETE FROM blog_posts WHERE id = '$id' AND user_id = '$user_id'";
    $delete_result = mysqli_query($conn, $delete_sql);

    if ($delete_result) {
        // Redirect to the page after successful deletion
        header("Location: home.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        echo "Failed to delete the blog post.";
    }
}

$sql = "SELECT * FROM blog_posts";
$result = mysqli_query($conn, $sql);
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

<section>
    <h1 style="padding: 20px 0 0 20px;" class="all-blogs-title title">All blog posts</h1>
    <div class="blog_posts">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="blog_post">
                    <div class="blog_post-image-div">
                        <img src="' . $row['image'] . '" alt="">
                    </div>
                    <div class="blog_post-name-date">
                        <p>' . $row['created_at'] . '</p>
                    </div>
                    <div class="blog_post-title-summary">
                        <h2><a href="view-post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>
                        <p>' . $row['summary'] . '</p>
                    </div>
                    </div>';
            }
        } else {
            echo "No blog posts found.";
        }
        ?>
    </div>
</section>
</body>
</html>