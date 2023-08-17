<?php
// $title="Home Page";
include "../../layout/head.php";
include "../../Models/Admin/getUsers.php";
include "../../Models/products.php";
include "../../connection_credits.php";
include "../../connection.php";
include_once $_SERVER["DOCUMENT_ROOT"] . '/Cafe_php_project/Controllers/users/users.php';


include "../../Controllers/categories.php";
include "../../Models/categories.php";
include "../../MiddleWares/auth.php";
include "../../MiddleWares/admin.php";




$users  = getAllUsers();
$products = DisplayAllProductsQuery();
$categories = DisplayCategory();

echo '
<main style="width:80%;margin-left:auto" class="dashboard">
<section class="X-Hero">
<div>
    <img class="animated-graph" src="https://cdn.dribbble.com/users/3593/screenshots/2475280/linechart.gif">
</div>
</section>

<section>
    <div class="container linear-graph position-relative mt-5">
        <h1>Orders Graph</h1>
        <span class="Y-Axis">Number Of Orders</span>
        <canvas width="1000" height="500"></canvas>
        <div class="row X-Axis">
            <span>2020</span>
            <span>2021</span>
            <span>2022</span>
            <span>2023</span>
            <span>2024</span>
        </div>
    </div>
</section>
<section class="py-5 testmilion">
    <h1>Testmilions</h1>
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="dash-card">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <br>
                    <span>Users</span>
                    <br>
                    <span>' . sizeof($users) . 'K</span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="dash-card">
                    <i class="fa-solid fa-dolly"></i>
                    <br>
                    <span>Products</span>
                    <br>
                    <span>' . sizeof($products) . 'K</span>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="dash-card">
                    <i class="fa-solid fa-tags"></i>
                    <br>
                    <span>Categories</span>
                    <br>
                    <span>' . sizeof($categories) . '</span>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<script src="../../Controllers/script.js">
</script>
';
