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





