<link rel="stylesheet" href="../assets/style.css">

<?php
ob_start();
session_start();

// include '../../Controllers/users/users.php';
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark ournav">
  <a class="navbar-brand" href="#">Cafeteria<img width="25" src="/Cafe_php_project/assets/design-imgs/Food_(1).png" alt=""></a>
  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php
    if (isset($user) && $user['role'] === 0) { ?>
      <ul class="navbar-nav m-auto">
        <li class="nav-item">
          <a href="/Cafe_php_project/Views/register/home.php" class="nav-link">Home<i class="fas fa-house-user pl-2"></i></a>
        </li>
        <li class="nav-item mr-5 ml-5">
          <a href="/Cafe_php_project/Views/products/DisplayProductsUser.php" class="nav-link">Products<i class="fab fa-buffer pl-2"></i></a>
        </li>
        <li class="nav-item mr-5 ">
          <a href="/Cafe_php_project/Controllers/cart_controller.php" class="nav-link">Cart<i class="fas fa-cart-arrow-down pl-2"></i></a>
        </li>
        <li class="nav-item">
          <a href="/Cafe_php_project/Views/userorders.php" class="nav-link">My Orders</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="#" class="nav-link"><?= $user['username'] ?><i class="fas fa-user pl-2"></i></a>
        </li>
        <li class="nav-item mr-2">
          <a class="nav-link" href="/Cafe_php_project/Views/register/logout.php">LogOut<i class="fas fa-arrow-right-to-bracket pl-2"></i></a>
        </li>
        <li class="nav-item">
          <a class="online-dote"><img src="<?php echo substr($user['image'], 15); ?>" width="30" alt="" class="user-img"></a>
        </li>
      </ul>
    <?php } ?>
    <?php
    if (isset($user) && $user['role'] === 1) { ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a href="/Cafe_php_project/Views/register/adminHomePage.php" class="nav-link">Home<i class="fas fa-house-user pl-2"></i></a>
        </li>
        <li class="nav-item">
          <a href="/Cafe_php_project/Views/products/DisplayProductsUserForAdmin.php" class="nav-link">Products<i class="fas fa-house-user pl-2"></i></a>
        </li>
        <li class="nav-item mr-3">
          <a href="/Cafe_php_project/Controllers/cart_controller.php" class="nav-link">Cart<i class="fas fa-cart-arrow-down pl-2"></i></a>
        </li>
        <li class="nav-item">
        <li class="nav-item mr-3">
          <a href="#" class="nav-link"><?= $user['username'] ?><i class="fas fa-user pl-2"></i></a>
        </li>
        <li class="nav-item mr-3">
          <a class="nav-link" href="/Cafe_php_project/Views/register/logout.php">LogOut<i class="fas fa-arrow-right-to-bracket pl-2"></i></a>
        </li>
        <li class="nav-item mr-2">
          <a class="online-dote pr-2"><img src="<?php echo substr($user['image'], 15); ?>" width="30" alt="" class="user-img"></a>
        </li>
      </ul>
    <?php }
    if (!isset($user)) { ?>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="/Cafe_php_project/Views/register/login.php">Login<i class="fas fa-arrow-right-from-bracket pl-2"></i></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="/Cafe_php_project/Views/register/signup.php">SignUp<i class="fas fa-user-plus pl-2"></i></a>
        </li>
      <?php } ?>
      </ul>
  </div>
</nav>