<?php

include '../components/connect.php';

session_start();
$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    // Assuming the default admin ID is 1
    header('location:admin_login.php');
}else{
    echo $_SESSION['admin_id'];
}

if(!isset($_GET['post_id'])){
    header('location:view_posts.php');
}else{
    $get_id = $_GET['post_id'];
}

if(isset($_POST['save'])){
    
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    
    
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    
    
    
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $update_post = $conn->prepare("UPDATE `posts` SET title = ?, content = ?, category = ?, status = ? WHERE id = ?");
    $update_post->execute([$title, $content, $category, $status, $get_id]);

    $message[] = 'post updated!';


    $old_image = $_POST['old_image'];
    $old_image = filter_var($old_image, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' .$image;


    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
    $select_image->execute(([$image, $admin_id]));

    if(!empty($image)){
        if($select_image->rowCount() > 0 AND $image != ''){ 
            $message[] = 'Please Rename your image!';
        }elseif($image_size > 2000000){
            $message[] = "Image is too Large!!";
        }else{
            $update_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $get_id]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'image updated!';
            if($old_image != $image AND $old_image != ''){
                unlink('../uploaded_img/'.$old_image);
            }
        }
    }else{
        $image = '';
    }


}

if(isset($_POST['delete'])){
    $delete_id = $_POST['post_id'];
    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ? ");
    $select_image->execute([$delete_id]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);
    if($fetch_image['image'] != ''){
        unlink('../uploaded_img/'.$fetch_image['image']);
    }
    $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
    $delete_comments->execute([$delete_id]);
    $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE post_id = ?");
    $delete_likes->execute([$delete_id]);
    $delete_posts = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
    $delete_posts->execute([$delete_id]);
    header('location:view_posts.php');


}

if(isset($_POST['delete_image'])){

    $empty_image = '';
    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE id = ? ");
    $select_image->execute([$get_id]);
    $fetch_image = $select_image->fetch(PDO::FETCH_ASSOC);
    if($fetch_image['image'] != ''){
        unlink('../uploaded_img/'.$fetch_image['image']);
    } 
    $unset_image = $conn->prepare("UPDATE `posts` SET image = ? WHERE id = ?");
    $unset_image->execute([$empty_image, $get_id]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <script src="https://kit.fontawesome.com/d2314fe5d0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>


<?php include '../components/admin_header.php' ?>





<section class="post-editor">
    <h1 class="heading">Edit Post</h1>
    <?php

    $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ? AND admin_id = ?");
    $select_posts->execute([$get_id, $admin_id]);
    if($select_posts->rowCount() > 0){
        while($fetch_post = $select_posts->fetch(PDO::FETCH_ASSOC)){
            
       
    
    ?>
    <form action="" method="post" enctype="multipart/form-data" class="add">
        <input type="hidden" name="post_id" value="<?=$fetch_post['id']?>">
        <input type="hidden" name="old_image" value="<?=$fetch_post['image']?>">
        <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
        <p>Post Status <span>*</span></p>
            <select name="status" required class="box">
                <option value="<?=$fetch_post['status']?>" selected><?=$fetch_post['status']?></option>
                <option value="active">active</option>
                <option value="deactive">deactive</option>
            </select>
        <p>Post Title <span>*</span></p>
        <input type="text" name="title" placeholder="add post title" maxlength="100" class="box" value="<?= $fetch_post['title']; ?>">
        <p>Post Content <span>*</span></p>
        <textarea name="content" class="box" required maxlength="10000" id="" cols="30" rows="10" placeholder="wite your content"><?= $fetch_post['content']; ?></textarea>
        <p>Post category <span>*</span></p>
        <select name="category" id="" class="box" required>
        

            <option value="<?= $fetch_post['category'];?>"selected><?= $fetch_post ['category']; ?></option>
            <option value="travel">Travel</option>
  <option value="food">Food and Cooking</option>
  <option value="fashion">Fashion and Style</option>
  <option value="health">Health and Wellness</option>
  <option value="technology">Technology and Gadgets</option>
  <option value="parenting">Parenting and Family</option>
  <option value="finance">Personal Finance and Money Management</option>
  <option value="self-improvement">Self-Improvement and Personal Development</option>
  <option value="homedecor">Home Decor and Interior Design</option>
  <option value="diy">DIY and Crafts</option>
  <option value="fitness">Fitness and Exercise</option>
  <option value="beauty">Beauty and Skincare</option>
  <option value="education">Education and Learning</option>
  <option value="books">Book Reviews and Literature</option>
  <option value="business">Business and Entrepreneurship</option>
  <option value="mental-health">Mental Health and Mindfulness</option>
  <option value="gaming">Gaming and Entertainment</option>
  <option value="sports">Sports and Fitness</option>
  <option value="environment">Environmental Sustainability</option>
  <option value="art">Art and Creativity</option>
        </select>
        <p>Post Image</p>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp"  class="box">
        <?php 
            if($fetch_post['image'] != ''){
                ?>
            <img src="../uploaded_img/<?= $fetch_post['image'];?>" alt="" class="image">
            <input type="submit" value="Delete Image" name="delete_image" class="inline-delete-btn">
        <?php
            }
        ?>
        
        <div class="flex-btn">
            <input type="submit" value = "Save Post" name="save" class="btn">
            <a href="view_posts.php" class="option-btn">Go Back</a>
            <button type="submit" onclick="return confirm('delete this post')" name="delete" class="delete-btn">Delete</button>
        </div>
    </form>
     
    <?php
    }
     }else{
        echo'    <p class="empty">no post added yet!</p>
        ';
    }
    ?>
</section>



    
</body>
</html>