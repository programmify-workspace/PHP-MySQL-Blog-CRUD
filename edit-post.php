<?php
include("php/config.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Terminate the script to prevent further execution
}

$username = $_SESSION["username"];
$user_id = $_SESSION["ID"];

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the blog post from the database
    $select_sql = "SELECT * FROM blog_posts WHERE id = ? AND user_id = ?";
    $select_stmt = mysqli_prepare($conn, $select_sql);
    mysqli_stmt_bind_param($select_stmt, "ii", $id, $user_id);
    mysqli_stmt_execute($select_stmt);
    $select_result = mysqli_stmt_get_result($select_stmt);

    if ($select_result) {
        $post = mysqli_fetch_assoc($select_result);

        // Check if the blog post belongs to the current user
        if (!$post) {
            echo "You are not authorized to edit this post.";
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated values from the form submission
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Update the blog post in the database
    $update_sql = "UPDATE blog_posts SET title = ?, content = ? WHERE id = ? AND user_id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "ssii", $title, $content, $id, $user_id);
    $update_result = mysqli_stmt_execute($update_stmt);

    if ($update_result) {
        // Redirect to the updated blog post
        header("Location: view-post.php?id=$id");
        exit(); // Terminate the script to prevent further execution
    } else {
        echo "Failed to update the blog post.";
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
                <!-- <li class="login-registerbtn"><a href="">Login</a></li> -->
                <li >
                    <a href="profile.php" style="display: flex; gap: 10px;" class="sub-nav-menu">
                        <p ><?php echo $username ?>'s account</p>
                        <div class="profile-pic">
                            <i class="fa-solid fa-user" style="font-size: 20px;"></i>
                        </div>
                    </a>
                </li>
                <li class="login-registerbtn"><a href="logout.php">Sign out</a></li>
            </div>
        </nav>
    </header>
    
    <section class="create-post-section" style="margin-top: 20px;">
        <form method="POST" action="">
            <div class="field">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>" >
            </div>

            
            <div class="field">
                <label for="content">Content:</label>
                <textarea type="text" name="content" id="content"  style="height: 400px;"><?php echo $post['content']; ?></textarea>
            </div>
            
            <div>
                <input style="margin: auto; display:flex;" type="submit" name="submit" id="submit" value="Update"  >
            </div>

            
            
            
            
            
        </form>
    </section>
</body>
</html>