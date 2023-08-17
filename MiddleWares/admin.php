<?php 
///in admin page 
if($_SESSION['user']['role']==0)
{
    header('location:/Cafe_php_project/Views/register/home.php');
}