<?php
include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/Controllers/users/users.php';
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/Models/products.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/connection_credits.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/connection.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/MiddleWares/auth.php";
include $_SERVER["DOCUMENT_ROOT"]."/Cafe_php_project/MiddleWares/user.php";

$user = getCurrentUser();

//Pagination for products
$Products = DisplayNewestProductsQuery() ?? "";
?>
<!-- Style For Products In Home -->
<link rel="stylesheet" href="../../layout/CSS/styleHome.css">
<link rel="stylesheet" href="../../assets/style_product.css">

<!-- Start Header -->
<header class="p-50">
    <h1>Begin Your Day ,<br>
        With Your Fav Drink</h1>
    <p>
        " From rich and velvety hot chocolates to refreshing<br> ice-cold lemonades,our drinks are crafted with <br>passion and care to satisfy every taste bud."
    </p>
    <div class="order_btn">
        <a href="#products"><button type="button" class="btn btn-light">Order Now</button></a>

    </div>
</header>
<!-- End Header -->

<!-- Start Products -->
<div id="products">
    <div class="container_product">
        <div class="container">
            <h2 class="latest_products">latest products</h2>

            <div class="row">
                <div class="row container_products">
                    <?php
                    foreach ($Products as $row) {
                    ?>
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="card_container">
                                <div class="img_card">
                                    <img src="<?= $row['image'] ?>" alt="">
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
            </div>
        </div>
    </div>

</div>
<!-- End Products -->


<script src="../../Controllers/productScript.js"></script>
<script src="../../Controllers/script.js"></script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer_user.php'; ?>