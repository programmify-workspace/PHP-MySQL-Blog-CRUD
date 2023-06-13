<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('Location: admin_login.php');
   exit();
}

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   if (!empty($name)) {
      $select_name = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
      $select_name->execute([$name]);
      
      if ($select_name->rowCount() > 0) {
         $message[] = 'Username already taken!';
      } else {
         $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
         $update_name->execute([$name, $admin_id]);
         $message[] = 'Username updated';
      }
   }

   $empty_pass = '$2y$10$jbJ4Fzr5VDIsCD0TxX444uDt0a8PUCARLSGzYI4AnYusN9KzYgli6';
   $select_prev_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
   $select_prev_pass->execute([$admin_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = $_POST['old_pass'];
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = $_POST['new_pass'];
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $c_pass = $_POST['c_pass'];
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);


   if ($old_pass !== $empty_pass) {
      if ($old_pass !== $prev_pass) {
         $message[] = 'Old password not matched!';
      } elseif ($new_pass !== $c_pass) {
         $message[] = 'Confirmed password not matched!';
      } else {
         if ($new_pass !== $empty_pass) {
            $hashed_password = password_hash($c_pass, PASSWORD_DEFAULT);
            $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
            $update_pass->execute([$hashed_password, $admin_id]);
            $message[] = 'Password updated';
         } else {
            $message[] = 'Please enter a new password';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="form-container">

   <form action="" method="POST">
      <h3>Update Now</h3>
      <input type="text" name="name" maxlength="20"  placeholder="<?= $fetch_profile['name']?>" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" maxlength="20"  placeholder="enter your old_password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" maxlength="20"  placeholder="Enter your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="c_pass" maxlength="20"  placeholder="confirm your new password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>

</section>
















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>