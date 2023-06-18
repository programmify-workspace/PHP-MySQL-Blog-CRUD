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


<?php include("header.php") ?>

<section>
    <h1 style="padding: 20px 0 0 20px;" class="all-blogs-title title">All blog posts</h1>
    <div class="blog_posts">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $user_id = $row['user_id'];
                $user_sql = "SELECT * FROM users WHERE id = $user_id ";
                $user_result = mysqli_query($conn, $user_sql);
                $user_row = mysqli_fetch_assoc($user_result);
                
                echo '<div class="blog_post">
                    <div class="blog_post-image-div" >
                        <img src="' . $row['image'] . '" alt="">
                    </div>
                    <div class="blog_post-name-date">
                        <p class="blog_post-name">' . ucwords($user_row['username']) . '</p>
                        <p>~</p>
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