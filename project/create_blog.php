<?php 
    include "layouts/header.php";
    // session_start();

    // Database connection
    $hostName = "localhost";
    $dbAuthor = "root";
    $dbPassword = "";
    $dbName = "blogs";
    $conn = mysqli_connect($hostName, $dbAuthor, $dbPassword, $dbName);

    if (!$conn) {
        die("Something went wrong;");
    }
?>

<div class="blog-container" style="margin: 20px 0;">
    <?php
    if (isset($_POST["submit"])) {
        $author = $_POST["author"];
        $title = $_POST["title"];
        $date = $_POST["date"];
        $summary = $_POST["summary"];
        
        $errors = array();
           
        if (empty($author) || empty($title) || empty($date) || empty($_FILES['image']['name']) || empty($summary)) {
            array_push($errors, "All fields are required");
        }
        
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            // Process the image file upload
            $image = $_FILES['image']['name'];
            $imageTmpName = $_FILES['image']['tmp_name'];
            $imageUploadPath = "images/" . $image;
            move_uploaded_file($imageTmpName, $imageUploadPath);

            // Save the blog post to the database
            $sql = "INSERT INTO info (author, title, date, image, summary) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $author, $title, $date, $imageUploadPath, $summary);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Blog successfully created.</div>";
            } else {
                echo "<div class='alert alert-danger'>Something went wrong.</div>";
            }
        }

        // File upload handling
        $image = $_FILES["image"]["name"];
        $imageTmp = $_FILES["image"]["tmp_name"];
        $imagePath = "images/" . $image;
        move_uploaded_file($imageTmp, $imagePath);
        
        $summary = $_POST["summary"];

        // Store form values in session variables
        $_SESSION["author"] = $author;
        $_SESSION["title"] = $title;
        $_SESSION["date"] = $date;
        $_SESSION["image"] = $imagePath;
        $_SESSION["summary"] = $summary;

        // Redirect to the new page
        
        header("Location: display_blog.php");
        exit();
    }
    ?>
    <?php
    if (isset($_SESSION["image"])) {
        echo "<label for='uploaded-image'>Uploaded Image:</label>";
        echo "<img src='" . $_SESSION["image"] . "' alt='Uploaded Image' style='max-width: 300px;'>";
    }
    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <style>
        .blog-container {
            margin: 20px 0;
        }

        .form {
            display: flex;
            flex-direction: column;
            width: 500px;
            margin: 0 auto;
            box-shadow: 2px 2px #fff, rgba(100, 100, 111, 1) 0px 7px 29px 0px;
            padding: 20px;
        }

        .form label {
            margin-bottom: 5px;
        }

        .form input[type="text"],
        .form input[type="date"],
        .form input[type="file"],
        .form textarea {
            margin-bottom: 10px;
        }

        .form input[type="submit"] {
            margin-top: 10px;
        }

        @media screen and (max-width: 789px) {
            .blog-container {
                width: 100%;
            }
            
            .form {
                width: 100%;
                max-width: 350px;
                display: flex;
                flex-direction: column;
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: flex; flex-direction: column; width: 500px; margin: 0 auto; box-shadow: 2px 2px #fff; box-shadow: rgba(100, 100, 111, 1) 0px 7px 29px 0px; padding: 20px;" enctype="multipart/form-data" class="form">
        <label for="author">Author</label>
        <input type="text" id="author" name="author" required><br>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required><br>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" required><br>
        <label for="image">Insert an image</label>
        <input type="file" id="image" name="image" required><br>
        <label for="summary">Summary</label>
        <textarea name="summary" id="summary" cols="50" rows="10" required></textarea><br>
        <input type="submit" value="Create" id="submit" name="submit">
    </form>
    
</div>
