<?php
    ob_start();

    require_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
    include "../../../MiddleWares/auth.php";
    include "../../../MiddleWares/admin.php";

    // include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';

    if(isset($_GET['do'])) {

        $do = $_GET['do'];
    
        if ($do == 'edit') { 
        
        // check if request userid is numeric & get the integer value of it
        $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
            
            $conn = connect();
            // To Get All Data From DataBase
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
            // Execute query
            $stmt->execute(array($userid));
            // fetch the data
            $row = $stmt->fetch();
            // the row count
            $count = $stmt->rowCount();
            // if there's such id show the form
            if ($stmt->rowCount() > 0) { 
                ?>
                <section class="vh-100">
                    <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center h-100 mt-5">
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0" style="color: black;">Edit<span style='color: white;'>User</span></span>
                        </div>
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <!-- <input type="hidden" name="userid" value="<?php echo $userid ?>" /> -->
                        <!-- Start Username Field -->
                        <div class="form-outline mb-4">
                            <lable class="col-sm-2 control-lable">Username</lable>
                            <div>
                                <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control form-control-lg" autocomplete="off" />
                            </div>
                        </div>
                        <!-- End Username Field -->
                        <!-- Start Password Field -->
                        <div class="form-outline mb-4">
                            <lable class="col-sm-2 control-lable">Password</lable>
                            <div>
                                <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" class="form-control form-control-lg"/>
                                <input type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="If You Don't need to Change The Password Take This Empty" />
                            </div>
                        </div>
                        <!-- End Password Field -->
                        <!-- <div class="form-group form-group-lg"> -->
                        <div class="form-outline mb-4">
                            <lable class="col-sm-2 control-lable">Select Role</lable>
                            <div>
                                <select name="role" id="" class="form-control form-control-lg">
                                    <option value="<?php echo $row['role'] ?>"><?php echo $row['role'] == 0 ? 'Normal User' : 'Admin' ?></option>
                                    <option value="0">Normal User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Fullname Field -->
                        <!-- Image -->
                        <div>
                            <label class="form-label" for="form1Example1322">Upload Image</label>
                            <input type="file" id="form1Example1322" name="image" class="form-control form-control-lg" />
                        </div>
                        <!-- Start Button Field -->
                        <div class="form-group mt-2 w-25">
                            <div>
                                <input type="submit" value="Save" class="btn btn-primary w-100">
                            </div>
                        </div>
                        <!-- End Button Field -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php }}
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            $username = $data['username'];
            $id = $userid;
            $role = $data['role'];
            $password = empty($data['newpassword']) ? $data['oldpassword'] : password_hash($data['newpassword'], PASSWORD_DEFAULT);
            
            if(!empty($_FILES['image']['name'])) {
                
                // Handle image upload
                $image = $_FILES['image'];
                
                $image_name = $image['name'];
                
                $image_tmp_name = $image['tmp_name'];
                
                $image_error = $image['error'];
                
                if ($image_error === UPLOAD_ERR_OK) {
                    
                    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    
                    $allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
                    $editerrors = [];
                    
                    if (in_array($image_ext, $allowed_exts)) {
                        
                        $image_dest = $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/uploads/users/' . uniqid('', true) . '.' . $image_ext;
                        
                        move_uploaded_file($image_tmp_name, $image_dest);
                    } else {
                        
                        $editerrors['image'] = '<div class="alert alert-danger text-center" style="z-index: 100000;">Invalid image file type</div>';
                    }
                }
            } else {
                include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';
                $user = getUserById($id);
                // var_dump($user);
                $image_dest = $user['image'];
                
            }
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
            // pssword Validtion
            if(empty($password)) {
                $editerrors['password'] = '<div class="alert alert-danger text-center" style="z-index: 100000;">Password Is Required</div>';
            } elseif (!preg_match($password_regex, $password)) {
                $editerrors['password'] = '<div class="alert alert-danger text-center" style="z-index: 100000;">Write Strong Password</div>';
            }
            // Username Validation
            if(empty($username)) {
                $editerrors['username'] = '<div class="alert alert-danger text-center" style="z-index: 100000;">Username Is Required</div>';
            } elseif (strlen($username) < 3) {
                $editerrors['username'] = '<div class="alert alert-danger text-center" style="z-index: 100000;">Username Not Match</div>';
            }
    
            if (empty($editerrors)) {
                $stmt2 = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $stmt2->execute(array($id));
                $count = $stmt2->rowCount();
                if ($count == 1) {
                    $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, image = ?, role = ? WHERE id = ?");
                    $stmt->execute(array($username, $password, $image_dest, $role, $id));
                    $count = $stmt2->rowCount();
                    // echo Success Message
                    echo '<div class="alert alert-success text-center mt-5">' . $stmt->rowCount() . ' Data Updated</div>';
                    exit();
                } else {
                    echo 'Something Wrong';
                }
            } 
            else {
                foreach ($editerrors as $error) {
                    echo $error;
                }
            }
        }
    } 
    include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php';
ob_end_flush();
?>
</section>