<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/navbar.php';
if(isset($_GET['codeverify'])) {

    $codeverify = $_GET['codeverify'];

    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
    $conn = connect();

    $stmt = $conn->prepare("SELECT * FROM users WHERE codeverify=:codeverify");
    $stmt->bindParam(':codeverify', $codeverify);
    $stmt->execute(array($codeverify));
    $count = $stmt->rowCount();
    if ($count == 0) {
        header('Location: login.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password=:new_password WHERE codeverify=:codeverify");
        $stmt->bindParam(':new_password', $new_password);
        $stmt->bindParam(':codeverify', $codeverify);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            echo '<span class="alert alert-success">Password Updated Successfully</span>';
        } else {
            echo 'error';
        }
    } 
}

?>
<div class="container my-5">
    <div class="form-outline mb-4">
    <form method="post">
        <label class="form-label" for="form1Example23">New Password</label>
        <input type="password" id="form1Example23" name="new_password" class="form-control form-control-lg" />
        <button type="submit" class="btn btn-primary btn-lg btn-block signup-btn">reset</button>
    </form>
</div>
</div>
<!-- Password input -->
<?php include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php';?>