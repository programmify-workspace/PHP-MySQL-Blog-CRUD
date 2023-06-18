<?php 
    include("php/config.php");
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit; // Add an exit statement after the header redirect
    }
 
    $username = $_SESSION["username"];

    if (isset($_POST["submit"])) {
        $title = $_POST["title"];
        $summary = $_POST["summary"];
        $content = $_POST["content"];

        $image = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];

        // Specify the target directory to save the uploaded image
        $targetDirectory = "images/";
        $targetPath = $targetDirectory . $image;

        // Move the uploaded image to the target directory
        if (move_uploaded_file($imageTmpName, $targetPath)) {
            // Image upload success

            // Process the content to preserve paragraphs and spacing
            $content = nl2br($content);

            // Save the blog post to the database
            $sql = "INSERT INTO blog_posts (user_id, title, summary, content, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "issss", $_SESSION['ID'], $title, $summary, $content, $targetPath);
                mysqli_stmt_execute($stmt);
                $mess = "<div class=' alert-success'>Blog successfully created.</div>";
            } else {
                echo "<div class=' alert-danger'>Something went wrong.</div>";
            }
        } else {
            // Image upload failed
            echo "<div class='alert alert-danger'>Failed to upload the image.</div>";
        }
    }
?>



    <?php include("header.php") ?>

    <section class="create-post-section" style="margin-top: 20px;">
        <h1 class="form-title">Create a new blog post</h1>
        <?php if(isset($mess)){echo $mess;} ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="field">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" placeholder="Enter title" required>
            </div>
            <div class="field">
                <label for="summary">Summary:</label>
                <textarea style="height: 100px;" type="text" name="summary" id="summary" placeholder="Enter summary" required></textarea>
            </div>
            <div class="field">
                <label for="content">Content:</label>
                <textarea type="text" name="content" id="content" placeholder="Enter content" required></textarea>
            </div>
            <div class="field">
                <label for="image">Image:</label>
                <input style="padding: unset;" type="file" name="image" id="image" required>
            </div>
            <div>
                <input style="margin: auto; display:flex;" type="submit" name="submit" id="submit" value="Create post"  required>
            </div>
        </form>
    </section>
</body>
</html>





