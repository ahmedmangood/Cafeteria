<?php 
ob_start();

// if(!isset($_SESSION['user']))
// {
//     header('location:/Cafe_php_project/Views/register/login.php');
// }

 include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Models/users/user.php';

 if(CheckIfUserDeleted($_SESSION['user']['id'])){
    header('Location:/Cafe_php_project/Views/register/logout.php');
 }

?>