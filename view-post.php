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
// Check if a user is logged in
if (isset($_SESSION["user"])) {
    $username = $_SESSION["username"];
    $user_id = $_SESSION["ID"];
} else {
    // Set default values for non-logged-in users
    $username = "Guest";
    $user_id = 0;
}
?>

<?php include("./header.php") ?>

<section class="full-post">
    <div style="margin:auto;">
        <img src="<?php echo $post['image']; ?>" width="500px" alt="">
    </div>
    <h1 class="post-title title" style="color: var(--scantyColor);"><?php echo $post['title']; ?></h1>
    <div class="post-content"><?php echo '<p>' . $post['content'] . '</p>'; ?></div>
</section>