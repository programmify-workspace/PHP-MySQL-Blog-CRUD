<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <script src="https://kit.fontawesome.com/d2314fe5d0.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>





<section class="categories">

   <h1 class="heading">post categories</h1>

   <div class="box-container">
   <div class="box"><span>1</span><a href="category.php?category=shopping">shopping</a></div>
<div class="box"><span>2</span><a href="category.php?category=animations">animations</a></div>
<div class="box"><span>3</span><a href="category.php?category=books">books</a></div>
<div class="box"><span>4</span><a href="category.php?category=electronics">electronics</a></div>
<div class="box"><span>5</span><a href="category.php?category=travel">travel</a></div>
<div class="box"><span>6</span><a href="category.php?category=food">food</a></div>
<div class="box"><span>7</span><a href="category.php?category=sports">sports</a></div>
<div class="box"><span>8</span><a href="category.php?category=health">health</a></div>
<div class="box"><span>9</span><a href="category.php?category=technology">technology</a></div>
<div class="box"><span>10</span><a href="category.php?category=movies">movies</a></div>
<div class="box"><span>11</span><a href="category.php?category=music">music</a></div>
<div class="box"><span>12</span><a href="category.php?category=education">education</a></div>
<div class="box"><span>13</span><a href="category.php?category=art">art</a></div>
<div class="box"><span>14</span><a href="category.php?category=fashion">fashion</a></div>
<div class="box"><span>15</span><a href="category.php?category=beauty">beauty</a></div>
<div class="box"><span>16</span><a href="category.php?category=home">home</a></div>
<div class="box"><span>17</span><a href="category.php?category=gaming">gaming</a></div>
<div class="box"><span>18</span><a href="category.php?category=finance">finance</a></div>
<div class="box"><span>19</span><a href="category.php?category=pets">pets</a></div>
<div class="box"><span>20</span><a href="category.php?category=photography">photography</a></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>
<script src="script.js"></script>

</body>
</html>