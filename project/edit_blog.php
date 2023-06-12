<?php
include "layouts/header.php";

// Database connection
$hostName = "localhost";
$dbAuthor = "root";
$dbPassword = "";
$dbName = "blogs";
$conn = mysqli_connect($hostName, $dbAuthor, $dbPassword, $dbName);

if (!$conn) {
    die("Something went wrong;");
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $blogId = $_POST['blog_id'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $summary = $_POST['summary'];

    // Update the blog post in the database
    $updateQuery = "UPDATE info SET author='$author', title='$title', date='$date', summary='$summary' WHERE id=$blogId";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo "<div class='alert alert-success'>Blog post updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update blog post.</div>";
    }
}

// Retrieve the blog post details based on the blog ID
$blogId = $_GET['id'];
$fetchQuery = "SELECT * FROM info WHERE id=$blogId";
$fetchResult = mysqli_query($conn, $fetchQuery);

if (mysqli_num_rows($fetchResult) > 0) {
    $blog = mysqli_fetch_assoc($fetchResult);
?>

<div class="container" >
    <h1>Edit Blog</h1>
    <form action="" method="POST" style="display: grid;">
        <input type="hidden" name="blog_id" value="<?php echo $blog['id']; ?>">
        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="<?php echo $blog['author']; ?>">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo $blog['title']; ?>">
        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="<?php echo $blog['date']; ?>">
        <label for="summary">Summary</label>
        <textarea name="summary" id="summary" cols="50" rows="10"><?php echo $blog['summary']; ?></textarea>
        <input type="submit" value="Update" name="submit">
        <a href="dashboard.php" class="btn btn-warning">Go to dashboard</a>
    </form>
</div>

<?php
} else {
    echo "<div class='alert alert-info'>Blog post not found.</div>";
}

mysqli_close($conn);
?>

</body>
</html>
