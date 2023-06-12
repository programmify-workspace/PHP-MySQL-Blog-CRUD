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

// Retrieve all blog posts from the database
$sql = "SELECT * FROM info";
$result = mysqli_query($conn, $sql);

?>

<div class="blogs">
    <h3 style="margin: 30px 0 50px; text-align: center; font-size: 40px;">All Blogs</h3>
    <div class="blog-row">
        <?php
        $count = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($count % 2 == 0) {
                    echo "<div class='blog-column'>";
                }
                echo "<div class='blog-container sm-container' style='background: #0f0; color: #000; width: 500px; color: black; padding: 20px; border: 2px solid #ff0; display: flex; flex-direction: column; margin: 0 auto 50px; border-radius: 0px 0;' >";
                echo "<img src='" . $row['image'] . "' alt='Blog Image' style='width: 450px; border-radius: 0px 0; display: flex; margin: 0 auto 10px;'>";
                echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
                echo "<p><strong>Title:</strong> " . $row['title'] . "</p>";
                echo "<p><strong>Date:</strong> " . $row['date'] . "</p>";
                echo "<a href='display_full_content.php?id=" . $row['id'] . "' style='color: #000;' class='btn btn-warning'>See More</a>";
                echo "</div>";
                if ($count % 2 == 1) {
                    echo "</div>";
                }
                $count++;
            }
            if ($count % 2 == 1) {
                echo "</div>";
            }
        } else {
            echo "<div class='alert alert-info'>No blogs found.</div>";
        }
        ?>
    </div>
</div>

<style>
    .blog-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .blog-column {
        width: 50%;
        padding: 0 15px;
        box-sizing: border-box;
    }

    @media screen and (max-width: 789px) {
        .blog-column {
            width: 100%;
        }
        .sm-container{
            max-width: 300px;
        }

        .blog-container {
            width: 100%;
        }
        .blog-container img{
            max-width: 250px;
        }
    }
</style>

</body>
</html>
