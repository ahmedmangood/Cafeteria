<?php

// include "../../Validation/registerValidation/";
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Validation/registerValidation/login.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Validation/registerValidation/signup.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';


// this function accept two parameters from validation file
// when aleardy clean without errors any from user inputs
function loginUser($email, $password) {
    
    $conn = connect();
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    
    $stmt->execute([$email]);
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($user && password_verify($password, $user['password'])) {
       
        // session_start();
       
        $_SESSION['user'] = $user;
       
        return $_SESSION['user'];
    
    } else {
        return false;
    }
}

// if User Login Start Session
function isLoggedIn() {
    // session_start();
    return isset($_SESSION['user']);
}
// to Get The Data Of User who already login
function getCurrentUser() {
    return $_SESSION['user'];
}