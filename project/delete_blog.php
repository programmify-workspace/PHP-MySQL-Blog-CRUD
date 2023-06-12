<?php
// Database connection
$hostName = "localhost";
$dbAuthor = "root";
$dbPassword = "";
$dbName = "blogs";
$conn = mysqli_connect($hostName, $dbAuthor, $dbPassword, $dbName);

if (!$conn) {
    die("Something went wrong;");
}

// Check if the blog ID parameter is provided
if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Prepare and execute the SQL query to delete the blog
    $sql = "DELETE FROM info WHERE id = $blogId";
    if (mysqli_query($conn, $sql)) {
        echo "Blog deleted successfully.";
    } else {
        echo "Error deleting blog: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
