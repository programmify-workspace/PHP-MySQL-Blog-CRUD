<?php

include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $password = $_POST['pass'];

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
    $select_admin->execute([$name]);
    $admin = $select_admin->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: dashboard.php');
        exit(); 
    } else {
        $message = 'Incorrect username or password';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://kit.fontawesome.com/d2314fe5d0.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body style="padding-left: 0 !important;">
   <?php 
    if(isset($message)){
        echo '<div class="message">
                  <span>'.$message.'</span>
                  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
              </div>';
    }
    ?>

<div class="gee">

<section class="form-container">
    <form action="" method="post">
    <h3>Login Now</h3>
    <p>Default Username = <span>admin</span>  & password = <span>111</span></p>
        <input type="text" class="box" required placeholder="Enter your username" maxlength="20" name="name" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" class="box" required placeholder="Enter your password" maxlength="20" name="pass" oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" class="btn" name="submit" value="Login Now">
    </form>
    
</section>



</div>




<link rel="stylesheet" href="../js/admin_script.js">
    
</body>
</html>