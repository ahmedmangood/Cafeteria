<?php


    session_start();
    session_unset();
    session_destroy();
    header('Location:../../../../../../Cafe_php_project/Views/register/login.php');
    exit();
