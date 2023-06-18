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

    // Process the content to preserve paragraphs and spacing
    $content = nl2br($content);

    // Check if a new image file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $image = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $image_path = "images/" . $image;

        // Move the uploaded image to the "images" directory
        move_uploaded_file($image_tmp, $image_path);

        // Update the image path in the database
        $update_image_sql = "UPDATE blog_posts SET image = ? WHERE id = ? AND user_id = ?";
        $update_image_stmt = mysqli_prepare($conn, $update_image_sql);
        mysqli_stmt_bind_param($update_image_stmt, "sii", $image_path, $id, $user_id);
        mysqli_stmt_execute($update_image_stmt);
    }

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


<?php include("./header.php")?>

<section class="create-post-section" style="margin-top: 20px;">
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="field">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>" >
        </div>

        <div class="field">
            <label for="content">Content:</label>
            <textarea type="text" name="content" id="content" style="height: 400px;"><?php echo str_replace("<br />", "", $post['content']); ?></textarea>
        </div>

        <div class="field">
            <label for="image">Change image:</label>
            <div>
                <img id="image-preview" class="image-preview" src="<?php echo isset($post['image']) ? $post['image'] : ''; ?>" alt="Image Preview">
            </div>
            <input style="padding: unset;" type="file" name="image" id="image" onchange="readURL(this);">
        </div>

        <div>
            <input style="margin: auto; display:flex;" type="submit" name="submit" id="submit" value="Update">
        </div>
    </form>
</section>
</body>






<style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }
    </style>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</html>