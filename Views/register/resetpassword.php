<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $error;
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=:email");
    $stmt->execute(array($email));
    $count = $stmt->rowCount();
    if ($count == 1) {
        include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Views/register/mailer.php';
        sendPasswordResetEmail($email);
    } else {
        $error = '<div class="alert alert-danger my-5">Email is not found</div>';
    }
}
?>
<div class="container my-5">
<h1 class="my-5">Password Reset</h1>
<form method="POST" enctype="multipart/form-data">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form1Example13">Email address</label>
        <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-lg btn-block signup-btn">reset</button>
</form>
<?php if(!empty($error)){
        echo $error;
    } ?>
</div>
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php'; ?>