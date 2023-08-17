<?php

require $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/PHPmailer/Exception.php';
require $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/PHPmailer/PHPMailer.php';
require $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/PHPmailer/SMTP.php';

include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Views/register/resetpassword.php';
// require $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/vendor/autoload.php';

use PHPMailer\PHPMailer;
function sendPasswordResetEmail($email) {
try{

    $targetEmail = $email;
    
    $mail = new PHPMailer\PHPMailer(true); 
    $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ahmedmangood999@outlook.com';
    $mail->Password = 'Aa123#@!';
    $mail->SMTPSecure = 'STARTTLS';
    $mail->Port = 587;

    $mail->setFrom('ahmedmangood999@outlook.com', 'Cafee Team');
    
    $mail->addAddress($targetEmail);
    
    $codeverify = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
    
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = '
        <p>You have requested a password reset. Click the link below to reset your password:</p>'
      .'  <a href="http://localhost/Cafe_php_project/Views/register/newPassword.php?codeverify='.$codeverify.'">Reset Password</a>';
    
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';

    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:targetEmail");
    $stmt->bindParam(':targetEmail', $targetEmail);
    $stmt->execute(array($targetEmail));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $conn->prepare("UPDATE users SET codeverify=:codeverify WHERE email=:targetEmail");
        $stmt->bindParam(':codeverify', $codeverify);
        $stmt->bindParam(':targetEmail', $targetEmail);
        $stmt->execute();
        $mail->send();
        echo "<span class='alert alert-success'>Message has been sent</span>";
    } else {
        echo "<span class='alert alert-success'>Somthing Error please try again</span>";
    }
    
}catch (Exception $e) {
        echo '<span class"alert alert-danger">error while sending email please try again or call us</span>';
    }
}