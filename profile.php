<?php
include("php/config.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit(); // Terminate the script to prevent further execution
}

$username = $_SESSION["username"];
$user_id = $_SESSION["ID"];

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    
    // Delete the blog post from the database
    $delete_sql = "DELETE FROM blog_posts WHERE id = '$id'";
    $delete_result = mysqli_query($conn, $delete_sql);
    
    if ($delete_result) {
        // Redirect to the page after successful deletion
        header("Location: profile.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        echo "Failed to delete the blog post.";
    }
}

$sql = "SELECT * FROM blog_posts WHERE user_id = '$user_id' ";
$result = mysqli_query($conn, $sql);
?>


<?php include("header.php") ?>

    <section class="profile" style="position: relative; margin-bottom:100px;">
        <div style="background-color:white; height:250px;">
            <img style="width: 100%; height:250px; object-fit: cover;" src="./images/connectwithnature.jpg" alt="">
        </div>
        <div style="width: 150px; height: 150px; position: absolute; bottom: -60px; left: calc(50% - 75px); background-color:var(--backgroundColor); padding:2px; border-radius:50%;  background-color:white; box-sizing: content-box; border:5px solid var(--backgroundColor) ;">
            <img style="object-fit: cover; width: 150px; height:150px; border-radius:50%;" src="./assets/profile-pic.png" alt="">
        </div>
        <!-- <div style="position: absolute; top: 10px; right:10px; border: 1px solid var(--white); padding:10px; border-radius:10px; background-color:var(--primaryColor)">
            <p style="color:var(--backgroundColor);">Edit profile</p>
        </div> -->
    </section>
    
    <section>
        <h1 style="padding: 20px 0 0 20px;" class="all-blogs-title title">My blog posts</h1>
        <div class="blog_posts" >
            
            <?php
                if ($result) {
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        foreach ($row as $key => $each_post) {
                            $row[$key] = "$each_post";
                        }
                        $user_id = $row['user_id'];
                        $user_sql = "SELECT * FROM users WHERE id = $user_id ";
                        $user_result = mysqli_query($conn, $user_sql);
                        $user_row = mysqli_fetch_assoc($user_result);
                                    
                        echo '<div class="blog_post" >
                        <div>
                            <div class="blog_post-image-div"    >
                                <img src="' . $row['image'] . '" alt="" >
                            </div>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:20px; height:100%;  justify-content:space-between; ">
                            <div style="display:flex; flex-direction:column; gap:10px;">
                                <div class="blog_post-name-date">
                                    <p class="blog_post-name">' . ucwords($user_row['username']) . '</p>
                                    <p>~</p>
                                    <p>' . $row['created_at'] . '</p>
                                </div>
                                <div class="blog_post-title-summary">
                                    <h2><a href="view-post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h2>
                                    <p>' . $row['summary'] . '</p>
                                </div>
                            </div>
                            <div>
                                <div class="edit-or-delete" style="flex-direction:row; justify-content:center; gap:50px;">
                                    <p class="edit"><a href="edit-post.php?id=' . $row['id'] . '">Edit</a></p>
                                    <a class="delete" href="?delete=' . $row['id'] . '">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                } else {
                    echo "Failed to retrieve blog posts.";
                }
            ?>
        </div>
    </section>
</body>
</html>