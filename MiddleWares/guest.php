<?php 
if(isset($_SESSION['user']))
{
    if($_SESSION['user']['role']==1)
    {
        header('location:/Cafe_php_project/Views/Admin/users/listAllUsers.php');

    }else{
        header('location:/Cafe_php_project/Views/register/home.php');

    }
    
}

?>