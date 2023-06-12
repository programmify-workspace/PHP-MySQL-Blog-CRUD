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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve blog post from the database
    $sql = "SELECT * FROM info WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        echo "<div class='blog-container min-container' style='background: #0f0; color: #000; width: 800px; color: black; padding: 20px; border: 2px solid #ff0; display: flex; flex-direction: column; margin: 50px auto;' >";
        echo "<img src='" . $row['image'] . "' alt='Blog Image' style='width: 750px; display: flex; margin: 0 auto 10px;'>";
        echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
        echo "<p><strong>Title:</strong> " . $row['title'] . "</p>";
        echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
        echo "<p><strong>Summary:</strong> " . $row['summary'] . "</p>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-info'>Blog not found.</div>";
    }
} else {
    echo "<div class='alert alert-info'>Invalid blog ID.</div>";
}

?>
<style>
    @media screen and (max-width: 789px) {
        .min-container{
            max-width: 350px;
        }
        .blog-container img{
            max-width: 300px;
        }
    }
</style>

</body>
</html>
