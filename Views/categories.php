<?php
$title = "Category Page";

include "../layout/head.php";
// include "../Controllers/User/UserController.php";
include "../Controllers/categories.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
include "../Validation/validation.php";
include "../MiddleWares/auth.php";

include "../MiddleWares/admin.php";
$error_add;
$error_update;
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {

    if ($_GET['action'] === 'add') {
        AddCategory($_POST);
        // Handle add form data here
        $error_add = $error['name'] ?? '';
    } else if ($_GET['action'] === 'update') {
        $category_id = $_GET['category_id'];
        UpdateCategory($category_id, $_POST);
        $error_update = $error['name'] ?? "";
        // Handle update form data here
    }
}

?>
<!-- Main Css File For Product For Admin-->
<link rel="stylesheet" href="../assets/style_product_Admin.css">


<main style="width:80%;margin-left:auto">
    <div class="container_admin_category">
        <div class="container p-100 ">

            <form method="post" action="?action=add" enctype="multipart/form-data" class="add_form">
                <div class="form-group">
                    <label for="name">Category Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <?= $error_add ?? '' ?>
                <div class="add_form_btns">
                    <button type="submit" class=" my-3 btn_product btn_category">Add Category</button>
                    <button type="reset" class="btn_product btn_category  my-3">Reset</button>

                </div>
            </form>
            <div class="title_admin">
                <h1 class=" mx-auto text-center my-2 title_product"> our Categories </h1>
            </div>
            <table class="table table-striped table-Secondary border-dark table-hover text-center table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // $rows = DisplayCategory();
                    $rows = Display_All_Categories_Query_With_Pagination();
                    foreach ($rows as $row) {
                    ?>
                        <tr>
                            <?php foreach ($row as $field) {
                            ?>
                                <td><?= $field ?></td>
                            <?php     }   ?>
                            <!-- Button trigger modal -->
                            <td><a href="" class="btn btn-success edit-category" data-toggle="modal" data-target="#modelId" data-category-id="<?= $row['id'] ?>">Edit <i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete <i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
            <?php list(
                $currentPage,
                $total_pages,
            ) = pagination_category();
            printPages_category($total_pages, $currentPage, null);

            ?>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="category_id" name="name">
                        </div>
                        <?= $error_update ?? '' ?>
                        <!-- <button type="submit" id="submit_button" class="btn btn-primary my-3" disabled>Submit</button> -->
                        <!-- <button type="reset" class="btn btn-danger  my-3">Reset</button> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                    <button type="submit" id="submit_button" class="btn btn-primary my-3" disabled>Update</button>

                </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- Optional: Place to the bottom of scripts -->
<script>
    //*Passing the Category Id to the Url When Submit 
    const editButtons = document.querySelectorAll('.edit-category');
    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const categoryId = event.target.dataset.categoryId;
            const editUrl = `?action=update&category_id=${categoryId}`;
            document.querySelector('#modelId form').setAttribute('action', editUrl);
        });
    });
    //------------------------------------------------------------------------------------------------
    //*If The Input Is Empty Make the Submit Button Disable
    let categoryInput = document.getElementById('category_id');
    let submitButton = document.getElementById('submit_button');

    categoryInput.addEventListener('input', function() {
        if (categoryInput.value !== '') {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    });
</script>

<?php
include "../layout/footer.php"
?>