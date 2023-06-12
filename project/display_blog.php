<?php
include "layouts/header.php";
session_start();

// Check if the session variables are set
if (isset($_SESSION["author"]) && isset($_SESSION["title"]) && isset($_SESSION["date"]) && isset($_SESSION["image"]) && isset($_SESSION["summary"])) {
    $author = $_SESSION["author"];
    $title = $_SESSION["title"];
    $date = $_SESSION["date"];
    $image = $_SESSION["image"];
    $summary = $_SESSION["summary"];

    // Clear the session variables
    unset($_SESSION["author"]);
    unset($_SESSION["title"]);
    unset($_SESSION["date"]);
    unset($_SESSION["image"]);
    unset($_SESSION["summary"]);
?>
    <h2 style="margin: 30px; text-align: center;">Blog Successfully created!</h2>
    <div class="blog-container" style="margin: 20px auto; background: #0f0; display: flex; flex-direction: column; width: 700px; color: #000; padding: 30px 50px;">
        
        <img src="<?php echo $image; ?>" alt="Blog Image" style="max-width: 650px; display: flex; margin: 0 auto;">
        <p><strong>Author:</strong> <?php echo $author; ?></p>
        <p><strong>Title:</strong> <?php echo $title; ?></p>
        <p><strong>Date:</strong> <?php echo $date; ?></p>
        <p><strong>Image:</strong></p>
        <p><strong>Summary:</strong> <?php echo $summary; ?></p>
        <a class="btn btn-warning" href="dashboard.php">Go to Dashboard</a>
    </div>
<?php
} else {
    echo "<div class='alert alert-info'>No blog found.</div>";
}

?>
