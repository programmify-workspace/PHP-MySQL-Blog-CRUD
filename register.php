


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
    <header style="margin: auto; display: flex; justify-content: center; margin-bottom: 50px;">
            <div class="blog-logo-container">
                <img src="./assets/techtype-logo.png" alt="">
            </div>
            <h1 class="blog-name" ><a href="home.php">Techtype</a></h1>
    </header>

    <?php
    include ('php/config.php');

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // verifying unique email

        $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email ='$email'");

        if(mysqli_num_rows($verify_query) != 0){
            $used_email_message = "<p style='display: flex; text-align:center; justify-content:center; color:red;'>This email belong to another account, try another one </p>";
        }else{
            mysqli_query($conn, "INSERT INTO users(username,email,password)VALUES('$username','$email','$password')") or die("Error occured!!!");

            echo "<style>
                .form-container{
                    display:none;
                }
                </style>";

            echo "<div style='display: flex; flex-direction:column; text-align:center; justify-content:center; gap: 20px; margin: auto;'>
                <h2 style='color: green; font-size:36px'>Registration successful</h2>
                <p class='form-extra' style='font-size: 20px;'>Click here to <a href='login.php'>Login now</a></p>
                </div>";
        }
    }
    else{
         
    }
?>

    <section class="form-container " >
        <h2 class="form-title">Create Account</h2>
        <?php if (isset($used_email_message)) { echo $used_email_message; }?>
        <form action="" method="POST" >
        <div class="field">
            <label for="username">Username:</label>
            <input class="input" type="text" name="username" id="username" required>
        </div>

        <div class="field">
            <label for="email">Email:</label>
            <input class="input" type="email" name="email" id="email" required>
        </div>

        <div class="field">
            <label for="password">Password:</label>
            <input class="input" type="password" name="password" id="password" required>
        </div>

        <div class="field">
            <input class="submit" type="submit" name="submit" value="Create account" id="submit">
        </div>
            
        </form>
        <p class="form-extra" style="font-size: var(--sfs);">Already have an account? <a href="login.php" >Login here</a></p>
    </section>
</body>
</html>
