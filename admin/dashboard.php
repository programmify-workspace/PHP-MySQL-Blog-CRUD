<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    header('location:admin_login.php');
}else{
    echo $_SESSION['admin_id'];
}

$admin_id = $_SESSION['admin_id'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/d2314fe5d0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>


<?php include '../components/admin_header.php' ?>

<section class="dashboard">

<div class="heading">dashboard</div>
    <div class="box-container">

    <div class="box">
       <h3>Welcome</h3>
       <p><?= $fetch_profile['name']; ?></p>
       <a href="update_profile.php" class="btn">Update Profile</a>
    </div>

<div class="box">
    <?php 
    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
    $select_posts->execute([$admin_id]);
    $number_of_posts = $select_posts->rowCount();
    ?>
    <h3><?=$number_of_posts;?></h3>
    <p>posts added</p>
    <a href="add_post.php" class="btn">add new post</a>
</div>

<div class="box">
    <?php 
    $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
    $select_active_posts->execute([$admin_id, 'active']);
    $number_of_active_posts = $select_active_posts->rowCount();
    ?>
    <h3><?=$number_of_active_posts;?></h3>
    <p>active added</p>
    <a href="view_posts.php" class="btn">View post</a>
</div>

<div class="box">
    <?php 
    $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ? AND status = ?");
    $select_deactive_posts->execute([$admin_id, 'deactive']);
    $number_of_deactive_posts = $select_deactive_posts->rowCount();
    ?>
    <h3><?=$number_of_deactive_posts;?></h3>
    <p>deactive added</p>
    <a href="view_posts.php" class="btn">View post</a>
</div>







<div class="box">
    <?php 
    $select_users = $conn->prepare("SELECT * FROM `users`");
    $select_users->execute();
    $number_of_users = $select_users->rowCount();
    ?>
    <h3><?=$number_of_users;?></h3>
    <p>total user </p>
    <a href="users_account.php" class="btn">View Users</a>
</div>
<div class="box">
    <?php 
    $select_admins = $conn->prepare("SELECT * FROM `admin`");
    $select_admins->execute();
    $number_of_admins = $select_admins->rowCount();
    ?>
    <h3><?=$number_of_admins;?></h3>
    <p>total admins </p>
    <a href="admin_account.php" class="btn">View admins</a>
</div>

<div class="box">
    <?php 
    $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
    $select_comments->execute([$admin_id]);
    $number_of_comments = $select_comments->rowCount();
    ?>
    <h3><?=$number_of_comments;?></h3>
    <p>total comments</p>
    <a href="comments.php" class="btn">View comments</a>
</div>

<div class="box">
    <?php 
    $select_like = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
    $select_like->execute([$admin_id]);
    $number_of_like = $select_like->rowCount();
    ?>
    <h3><?=$number_of_like;?></h3>
    <p>total likes </p>
    <a href="view_posts.php" class="btn">View likes</a>
</div>

    </div>

</section>







<link rel="stylesheet" href="../js/admin_script.js">
    
</body>
</html>