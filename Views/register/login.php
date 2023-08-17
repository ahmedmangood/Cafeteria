<?php

$pageTitle = 'login';
include '../../layout/head.php';
include '../../Validation/registerValidation/login.php';
include "../../MiddleWares/guest.php";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        loginValidation($_POST['email'], $_POST['password'], $errors);
    }
}

?>
<section class=" login_body">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center h-100 mt-5">
            <!-- <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="../../assets/design-imgs/cover.jpeg"
            class="img-fluid login-img" alt="Phone image">
        </div> -->
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #d4c085;"></i>
                    <span class="h1 fw-bold mb-0" style="color: #d4c085;">Log<span style='color: white;'>In</span></span>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form1Example13" name="email" class="form-control form-control-lg" />
                        <label class="form-label" for="form1Example13">Email address</label>
                        <br>
                        <?= $errors['email'] ?? "" ?>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form1Example23">Password</label>
                        <br>
                        <?= $errors['password'] ?? "" ?>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn_product btn-lg btn-block login-btn">Log In</button>
                    <div class="d-flex justify-content-around align-items-left mt-4">
                        <a href="signup.php">or SignUp?</a>
                        <a href="resetpassword.php">resest your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include '../../layout/footer.php';
?>