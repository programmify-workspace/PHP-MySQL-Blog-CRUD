<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];


if (!isset($admin_id)) {
    header('location:admin_login.php');
}

if(isset($_POST['publish'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    
    
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    
    $status = 'active';
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' .$image;


    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
    $select_image->execute(([$image, $admin_id]));

    if(isset($image)){
        if($select_image->rowCount() > 0 AND $image != ''){ 
            $message[] = 'Image name Repeated';
        }elseif($image_size > 2000000){
            $message[] = "Image is too Large!!";
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }

    if($select_image->rowCount() > 0 AND $image != ''){
        $message[] = 'Please rename your image';
    }else{
        $insert_post = $conn->prepare("INSERT INTO `posts` (admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
        $insert_post->execute([$admin_id, $name, $title, $content,   $category, $image, $status]);
        $message[] = 'Post Published!!';
    };

}

if(isset($_POST['draft'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $content = $_POST['content'];
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    
    
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    
    $status = 'deactive';
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' .$image;


    $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
    $select_image->execute(([$image, $admin_id]));

    if(isset($image)){
        if($select_image->rowCount() > 0 AND $image != ''){ 
            $message[] = 'Image name Repeated';
        }elseif($image_size > 2000000){
            $message[] = "Image is too Large!!";
        }else{
            move_uploaded_file($image_tmp_name, $image_folder);
        }
    }else{
        $image = '';
    }

    if($select_image->rowCount() > 0 AND $image != ''){
        $message[] = 'Please rename your image';
    }else{
        $insert_post = $conn->prepare("INSERT INTO `posts` (admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
        $insert_post->execute([$admin_id, $name, $title, $content,   $category, $image, $status]);
        $message[] = 'Draft Saved!!!';
    };

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <script src="https://kit.fontawesome.com/d2314fe5d0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>


<?php include '../components/admin_header.php' ?>


<section class="post-editor">
    <h1 class="heading">Add Post</h1>
    <form action="" method="post" enctype="multipart/form-data" class="add">
        <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
        <p>Post Title <span>*</span></p>
        <input type="text" name="title" placeholder="add post title" maxlength="100" class="box">
        <p>Post Content <span>*</span></p>
        <textarea name="content" class="box" required maxlength="10000" id="" cols="30" rows="10" placeholder="wite your content"></textarea>
        <p>Post category <span>*</span></p>
        <select name="category" id="" class="box" required>
        

            <option value="" disabled selected>-- Select post category</option>
            <option value="shopping">shopping</option>
            <option value="animations">animations</option>
            <option value="books">books</option> 
            <option value="electronics">electronics</option> 
            <option value="travel">travel</option> 
            <option value="food">food</option> 
            <option value="sports">sports</option> 
            <option value="health">health</option> 
            <option value="technology">technology</option> 
            <option value="movies">movies</option> 
            <option value="music">music</option> 
            <option value="education">education</option> 
            <option value="art">art</option> 
            <option value="fashion">fashion</option> 
            <option value="beauty">beauty</option> 
            <option value="home">home</option> 
            <option value="gaming">gaming</option> 
            <option value="finance">finance</option> 
            <option value="pets">pets</option> 
            <option value="photography">photography</option>
        </select>
        <p>Post Image</p>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp"  class="box">
        <div class="flex-btn">
            <input type="submit" value = "publish-post" name="publish" class="btn">
            <input type="submit" value = "save draft" name="draft" class="option-btn">
        </div>
    </form>
</section>


<link rel="stylesheet" href="../js/admin_script.js">
    
</body>
</html>