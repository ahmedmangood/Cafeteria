<?php 

include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';


    function loginValidation($email, $password,&$errors) {
        
        $errors=[];

        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        
        if(empty($email)) {
            $errors['email'] = '<div class="alert alert-danger">Email Is Required</div>';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '<div class="alert alert-danger">Write a Valid Email</div>';
        }
        // pssword Validtion
        if(empty($password)) {
            $errors['password'] = '<div class="alert alert-danger">Password Is Required</div>';
        } elseif (!preg_match($password_regex, $password)) {
            $errors['password'] = '<div class="alert alert-danger">Password is Not Correct!</div>';
        } 

        if(empty($errors)) {

            $userLogin = loginUser($email, $password);
            if($userLogin) {
                
                if($_SESSION['user']['role'] === 0) {
                    echo '<div class="alert alert-success">Welcome ' . $_SESSION['user']['username'] . ' You Will Redircet To Home Now</div>';
    
                    header("Location:home.php");
    
                } elseif ($_SESSION['user']['role'] === 1) {
                    echo '<div class="alert alert-success">Welcome ' . $_SESSION['user']['username'] . ' You Will Redircet To Admin Panel Now</div>';
                    header("refresh:3;url=../register/adminHomePage.php");
                }
                exit();
            } else {
                echo '<span class="alert alert-danger">faild to login with wrong email or password!</span>';
            }
        }
    }
