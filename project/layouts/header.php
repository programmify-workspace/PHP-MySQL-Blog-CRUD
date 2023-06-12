<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body style="background: #000; color: #fff;">
    <div class="nav" style="display: flex; gap: 60%; text-align: center; align-items: center; justify-content: center; background: #ff0; position: sticky; border-bottom: 5px solid #0f0; ">
        <a href="index.php" style="text-decoration: none; font-size: 25px; color: black; padding: 30px; color: #000; text-shadow: 2px 2px #0f0; font-weight: 900;"> Rach's Blog </a>
        <ul id="menu" style="display: flex; flex-direction: column; list-style-type: none; gap: 5px; margin: 0 auto; position: absolute; top: 0; left: 0; width: 50%; background-color: #000;  border-right: 2px solid #0f0; border-bottom: 2px solid #0f0; padding: 100px; transition: all 2s ease;">
            <?php
            session_start();
            if (isset($_SESSION["email"])) {
                echo '<li class="nav-item">
                        <a href="dashboard.php" class="nav-link" style="margin-left: -80px; color: #fff;">Logged in as ' . $_SESSION["email"] . '</a>
                      </li>';
            } else {
                echo '<li><a href="registration.php" style="text-decoration: none; margin: -90px; width: 150px; margin-top: -100px; margin-bottom: 50px;" class="btn btn-warning">Sign up</a></li>
                      <li><a href="login.php" style="text-decoration: none; margin: -90px; width: 150px; margin-top: -150px;" class="btn btn-warning">Login</a></li>';
            }
            ?>
            <div id="cancelBtn" style="position: absolute; top: 0; right: 10px; font-size: 20px; cursor: pointer;">&times;</div>
        </ul>
        <div id="desktopMenu" style="display: flex; gap: 5px;">
            <?php
            if (!isset($_SESSION["email"])) {
                echo '<a href="registration.php" style="text-decoration: none;" class="btn btn-warning">Sign up</a>
                      <a href="login.php" style="text-decoration: none;" class="btn btn-warning">Login</a>';
            } else {
                echo '<a href="dashboard.php"><span class="email" style="color: #000;"> Logged in as ' . $_SESSION["email"] . '</span></a>';
            }
            ?>
        </div>
    </div>
    <style>
        /* Styles for desktop */
        .email {
            display: inline-block;
            margin-left: 10px;
            color: #fff;
        }
    </style>

    <script>
    const menu = document.getElementById('menu');
    const hamburger = document.createElement('li');
    const hamburgerBtn = document.createElement('button');
    hamburgerBtn.classList.add('btn', 'btn-warning');
    hamburgerBtn.style.background = "none";
    hamburgerBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
    hamburgerBtn.addEventListener('click', toggleMenu);
    hamburger.appendChild(hamburgerBtn);
    document.querySelector('.nav').appendChild(hamburger);

    const cancelBtn = document.getElementById('cancelBtn');
    cancelBtn.addEventListener('click', toggleMenu);

    function toggleMenu() {
        menu.style.display = menu.style.display === 'none' ? 'grid' : 'none';
    }

    // Add media query for small screens
    const mediaQuery = window.matchMedia('(max-width: 789px)');
    function handleMediaQuery(mediaQuery) {
        if (mediaQuery.matches) {
            hamburger.style.display = 'flex';
            document.getElementById('desktopMenu').style.display = 'none';
        } else {
            hamburger.style.display = 'none';
            menu.style.display = 'none'; // Hide the menu on larger screens
            document.getElementById('desktopMenu').style.display = 'flex';
        }
    }
    mediaQuery.addListener(handleMediaQuery);
    handleMediaQuery(mediaQuery);

    // Hide the menu on page load
    menu.style.display = 'none';

    // Check if the current page is the dashboard and hide the menu
    const currentLocation = window.location.pathname;
    if (currentLocation.includes('dashboard.php')) {
        menu.style.display = 'none';
    }
</script>

</body>
</html>
