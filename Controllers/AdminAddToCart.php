<?php 
    session_start();

    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include "../Models/product_cartModel.php";
include "../Models/userCartModel.php";
include "../Models/order_model.php";
include "../connection_credits.php";
include "../connection.php";

 if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $adminid = $_SESSION['user']['id'];
    $products = selectCarts($adminid);
    $usercarts = selectUserCarts($adminid);
    if(sizeof($products) and sizeof($usercarts)){
        createOrder($_POST['user_id'],$products,$usercarts[0]['notes'],$usercarts[0]['total_price'],'pending');
        deleteAllCarts($adminid);   
        deleteUserCarts($adminid); 
        // var_dump('');
        header("Location:cart_controller.php");
}
}