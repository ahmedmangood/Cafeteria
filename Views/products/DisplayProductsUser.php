<?php
$title = "Shopping List";

include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/layout/head.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/MiddleWares/auth.php";

include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Controllers/categories.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Models/products.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Models/categories.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/connection_credits.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/connection.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Validation/validation.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Models/product_cartModel.php";






if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteProductQuery($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    if ($_GET['action'] === 'update') {
        $category_id = $_GET['category_id'];
        UpdateCategory($category_id, $_POST);
    }
}

// SEARCH for PRODUCT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ValueSearch = $_GET['search_term'] ?? "";
}

//Pagination for products
$productPagination = DisplayAvailableProductsQueryWithPagination();

// var_dump($productPagination );

?>
<!-- Main Css File For Product For User-->
<link rel="stylesheet" href="../../assets/style_product.css">
<!-- ----------------------------------------------------------------------------------------- -->
<div class="container p-50 ">
    <h1 class="  text-center my-4 all_products">All Products</h1>
    <!-- <h2 class="my-4">Products</h2> -->
    <!-- <a class="btn btn-primary" href="Add Products.php">Add Product</a> -->
    <form action="" method="GET" id="search-form" class="ml-auto w-50 text-right search_product_home">
        <input type="text" name="search_term" id="search-input" placeholder="Search On Your Product" value="<?php if (isset($_GET['search_term'])) {
                                                                                                                echo $_GET['search_term'];
                                                                                                            } ?>">
        <button type="submit" value="Search" class="btn_main">Search</button>
    </form>
    <div class="row container_products">
        <?php
        if (!empty($ValueSearch)) {
            $Products =  search_Product_With_Pagination_Query($ValueSearch) ?? "";
            // $Products = searchProductQuery($ValueSearch) ?? "";
            $_GET['search_term'] = "";
            // var_dump($Products);
        } else {
            // $Products = DisplayAvailableProductsQuery();
            $Products = $productPagination ?? "";
        }
        // var_dump(   $Products );
        foreach ($Products as $row) {
        ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card_container">
                    <div class="img_card">
                        <img src="../../<?= $row['image'] ?>" alt="">
                    </div>
                    <div class="card_body_product">
                        <div class="card_top">
                            <h3>
                                <?= $row['name'] ?>
                            </h3>
                            <?php

                            if ($row['quantity'] <= 0) {
                                echo "  <p class='UnAvailable container_avi' ><i class='fa-solid fa-circle'></i> UnAvailable </p>";
                            } else {
                                echo "  <p class='Available container_avi'><i class='fa-solid fa-circle'></i>Available  </p>";
                            }
                            ?>
                        </div>
                        <div class="card_bottom">
                            <h3>
                                <?= $row['price'] ?> <span>EGP</span>
                            </h3>

                            <button class="btn_card" <?php echo ($row['quantity'] <= 0) ? 'disabled="true"' : ''; ?> onclick="addToCart(event,<?= $row['id'] ?>,<?= $row['price'] ?>,<?= $_SESSION['user']['id'] ?> )">Add</button>
                        </div>
                        <!-- <a href="" class="btn btn-primary" >Add To Cart</a> -->
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php list(
        $currentPage,
        $total_pages,
    ) = pagination();
    printPages($total_pages, $currentPage, $ValueSearch);

    ?>

</div>
<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-3">
                <!-- <img src="../assets/images/pngwing.png" alt="" width="50" height="50"> -->
                <!-- <p>vsvsv</p> -->

            </div>
            <div class="col-md-3">
                <ul class="footer-list">
                    <li>Privacy Policy</li>
                    <li>Returns</li>
                    <li>Terms and Condition</li>
                    <li>Latest News</li>
                    <li>Blog</li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-list">
                    <li>Contact Us</li>
                    <li>Purchase information</li>
                    <li>Purchase details</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- Optional: Place to the bottom of scripts -->
<script src="../../Controllers/productScript.js"></script>
<script src="../../Controllers/script.js"></script>
<?php
// include '../../layout/footer_user.php';
?>