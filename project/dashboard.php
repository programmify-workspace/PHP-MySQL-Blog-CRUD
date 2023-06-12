<?php
include "layouts/header.php";
?>

<div class="container">
    <h1>Welcome to Dashboard</h1>
    <a href="create_blog.php" style="text-decoration: none;" class="btn btn-warning">Create a blog</a>
    <a href="logout.php" class="btn btn-warning">Logout</a>
</div>

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

// Retrieve all blog posts from the database
$sql = "SELECT * FROM info";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='blog-container small-container' style='background: #0f0; color: black; padding: 20px; border: 2px solid #ff0; width: 700px; display: flex; flex-direction: column; margin: 50px auto;'>";
        echo "<h2>Submitted Blog</h2>";
        echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
        echo "<p><strong>Title:</strong> " . $row['title'] . "</p>";
        echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
        echo "<p><strong>Image:</strong></p>";
        echo "<img src='" . $row['image'] . "' alt='Blog Image'>";
        echo "<p><strong>Summary:</strong> " . $row['summary'] . "</p>";
        echo "<div class='blog-buttons'>";
        echo "<a href='edit_blog.php?id=" . $row['id'] . "'class='btn btn-warning'>Edit</a>";
        echo "<button onclick='deleteBlog(" . $row['id'] . ")' class='btn btn-danger'>Delete</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='alert alert-info'>No blogs found.</div>";
}

mysqli_close($conn);
?>

<style>
    @media screen and (max-width: 789px) {
        /* .container {
            width: 50%;
            max-width: 200px;
        } */

        .small-container {
            width: 100%;
            max-width: 350px;
        }

        .blog-container p {
            width: 100%;
        }

        .blog-container img {
            width: 100%;
        }
    }
</style>

<script>
    function deleteBlog(blogId) {
        if (confirm("Are you sure you want to delete this blog?")) {
            // Perform an AJAX request to delete the blog
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Refresh the page to remove the deleted blog
                    location.reload();
                }
            };
            xhr.open("GET", "delete_blog.php?id=" + blogId, true);
            xhr.send();
        }
    }
</script>

</body>
</html>
