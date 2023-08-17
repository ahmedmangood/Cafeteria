<?php
    // session_start();
    ob_start();

    // include_once "../../Models/users/user.php";
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Models/users/user.php';

    $errorsValidation = [];
    function userValidation($data, $imageFile, &$errorsValidation):void {
        
        $errors = [];

        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $role = $data['role'] ?? 0;

        // Password Regx
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

        // Handle image upload
        $image = $imageFile['image'];

        $image_name = $image['name'];
    
        $image_tmp_name = $image['tmp_name'];
    
        $image_error = $image['error'];
    
        if ($image_error === UPLOAD_ERR_OK) {
    
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    
        $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
    
        if (in_array($image_ext, $allowed_exts)) {
    
            $image_dest = $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/uploads/users/' . uniqid('', true) . '.' . $image_ext;
           
            move_uploaded_file($image_tmp_name, $image_dest);

        } else {
    
            $errors['image'] = '<div class="alert alert-danger">Invalid image file type</div>';
       
        }
        
        } else {
    
            $errors['image'] = '<div class="alert alert-danger">Failed to upload image</div>';
        }
        
        // Email Validation

        if(empty($email)) {
            $errors['email'] = '<div class="alert alert-danger">Email Is Required</div>';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = '<div class="alert alert-danger">Write a Valid Email</div>';
        }

        // pssword Validtion
        if(empty($password)) {
            $errors['password'] = '<div class="alert alert-danger">Password Is Required</div>';
        } elseif (!preg_match($password_regex, $password)) {
            $errors['password'] = '<div class="alert alert-danger">Write Strong Password</div>';
        }
        // Username Validation
        if(empty($username)) {
            $errors['username'] = '<div class="alert alert-danger">Username Is Required</div>';
        } elseif (strlen($username) < 3) {
            $errors['username'] = '<div class="alert alert-danger">Username Not Match</div>';
        }

        if (empty($errors)) {
            $newUser = createNewUser($email, $password, $username, $image_dest, $role);
            if($newUser) {
                if(isset($_SESSION['user'])) {
                    echo '<span class="alert alert-success">Added User Successfully</span>';
                    header("Location:listAllUsers.php");
                } else {
                    echo '<span class="alert alert-success">Signup Successfully</span>';
                    header("Location:login.php");
                }
                exit();
            } else {
                echo '<span class="alert alert-danger">This User Is Already have account!</span>';
            }
        }
        else {
            $errorsValidation = $errors;
        }
        
    }

    ob_end_flush();
