<?php
//select usercarts
function selectUserCarts($userid)
{
    global $conn;

    $create_query = "select * from `carts` where `user_id` = :usrid";

    $stmt = $conn->prepare($create_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();

    $res = $stmt->fetchAll();

    return $res;
}

//update usercarts
function updateUserCarts($userid, $notes)
{

    global $conn;

    if ($notes == '') {
        $notes = selectUserCarts($userid)[0]['notes'];
    }

    $totalPrice = countTotalPrice($userid);

    $update_query = "update `carts` set `notes` = :note , `total_price` = :TP where `user_id`=:usrid";

    $stmt = $conn->prepare($update_query);

    $stmt->bindParam(':usrid', $userid);
    $stmt->bindParam(':note', $notes);
    $stmt->bindParam(':TP', $totalPrice);

    $stmt->execute();
}

//delete usercarts
function deleteUserCarts($userid)
{
    global $conn;

    $delete_query = "delete from `carts` where `user_id` = :usrid";

    $stmt = $conn->prepare($delete_query);

    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();
}

//function to save totalprice of all carts 
function createUserCarts($userid)
{
    global $conn;

    $totalPrice = countTotalPrice($userid);

    $create_query = "insert into `carts` (total_price,user_id) values (:totalprice,:usrid)";

    $stmt = $conn->prepare($create_query);

    $stmt->bindParam(':totalprice', $totalPrice);
    $stmt->bindParam(':usrid', $userid);

    $stmt->execute();
}

//function to count totalprice
function countTotalPrice($userid)
{

    $allcarts = selectCarts($userid);
    $allproducts = selectProducts();
    $totalPrice = 0;

    foreach ($allcarts as $cart) {
        foreach ($allproducts as $product) {
            if ($cart['product_id'] == $product['id']) {
                if ($product['quantity'] > 0) {
                    $totalPrice +=  $product['price'] * $cart['quantity'];
                }
            }
        }
    };

    return $totalPrice;
}
