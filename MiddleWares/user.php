<?php 
///in users page 
if($_SESSION['user']['role']==1)
{
    header('location:/Cafe_php_project/Views/register/adminHomePage.php');
}

