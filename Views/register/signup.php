<?php
    ob_start();

    $pageTitle = 'Signup';
    // include '../../layout/head.php';

    include '../../layout/head.php';

    include "../../MiddleWares/guest.php";
    
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Validation/registerValidation/signup.php';
            userValidation($_POST, $_FILES, $errors);
        }
?>
<section class="login_body">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100 mt-4">
   
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #d4c085;"></i>
            <span class="h1 fw-bold mb-0" style="color: #d4c085;">Sign<span style='color: white;'>Up</span></span>
        </div>
            <form method="POST" enctype="multipart/form-data">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Email address</label>
                <?= $errors['email'] ?? '' ?>
            </div>
            <!-- UserName input -->
            <div class="form-outline mb-4">
                <input type="text" id="form1Example1311" name="username" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example1311">UserName</label>
                <?= $errors['username'] ?? '' ?>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Password</label>
                <?= $errors['password'] ?? '' ?>
            </div>

            <!-- Image input -->
            <div class="form-outline mb-4">
                <input type="file" id="form1Example1322" name="image" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example1322">Upload Image</label>
                <?= $errors['image'] ?? '' ?>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn_product  btn-lg btn-block login-btn">Sign Up</button>
            <div class="d-flex justify-content-around align-items-left mt-4">
                <a href="login.php">or Log In?</a>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
</section>

<?php
include '../../layout/footer.php';
ob_end_flush();

?>