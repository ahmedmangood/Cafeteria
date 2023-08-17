<?php

    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Views/Admin/users/editUsers.php';

    function updateUser($data, $imageFile) {

        $errors = [];
        $id = $data['id'];
        $username = $data['username'];
        $email = $data['email'];
        $role = $data['role'];

        // Password Regx
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        
        $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
        
        
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
    
            $errors[] = 'Invalid image file type';
       
        }

        } else {
    
            $errors[] = 'Failed to upload image';
        }
    
        // Email Validation

        if(empty($email)) {
            $errors[] = 'Email Is Required';
        }   elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Write a Valid Email';
        }

        // pssword Validtion
        if(empty($pass)) {
            $errors[] = 'Password Is Required';
        } elseif (!preg_match($password_regex, $pass)) {
            $errors[] = 'Write Strong Password';
        }
        // Username Validation
        if(empty($username)) {
            $errors[] = 'Username Is Required';
        } elseif (strlen($username) < 3) {
            $errors[] = 'Username Not Match';
        }

        // Role Validation
        if($role == 1) {
            $role = 1;
        } else {
            $role = 0;
        }
    
        if(empty($errors)) {
            require_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
            $conn = connect();
            $stmt2 = $conn->prepare("SELECT * FROM users WHERE email = ? AND id != ?");

            $stmt2->execute(array($email, $id));

            $count = $stmt2->rowCount();

            if ($count == 1) {
                
                echo '<div class="error-msg">This User Is Exist</div>';
                header("Location:listAllUsers.php");
            
            } else {
                if(isset($image_dest)) {
                    $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, password = ?, image = ? role = ? WHERE id = ?");
                    $stmt->execute(array($email, $username, $pass, $image_dest, $role, $id));

                } else {
                    $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, password = ? role = ? WHERE id = ?");
                    $stmt->execute(array($email, $username, $pass, $role, $id));
                }
                // echo Success Message
            }
                $theMsg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Data Updated</div>';
                echo $theMsg;
        } else {
            foreach($errors as $err) {
                echo '<span class="alert alert-danger">' . $err . "</span>";
            }
        }
    }