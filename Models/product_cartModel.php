<?php

//function to select all carts 
function createCart($userid,$prodid,$price)
{
    global $conn;

    $create_query = "insert into `cart_product` (user_id,product_id,price) values (:usrid,:product_id,:price);";

    $stmt = $conn->prepare($create_query);

    $stmt->bindParam(':product_id', $prodid);
    $stmt->bindParam(':usrid', $userid);
    $stmt->bindParam(':price', $price);

    $stmt->execute();

    // createUserCarts($userid);

    // return $product;

}

//function to select all carts
function selectCarts($userid)
{
    global $conn;

    $select_query = "select * from `cart_product` where `user_id`= :stdusrid order by `cartid`;";

    $stmt = $conn->prepare($select_query);

    $stmt->bindParam(':stdusrid',$userid);

    $stmt->execute();

    $carts = $stmt->fetchAll();

    return $carts;
}

//function to update quantity
function updateCart($quantity,$product_id,$user_id,$productprice)
{
    global $conn;

    $update_query = "update `cart_product` set `quantity`=:stdquantity,`price`=:stdprdprice where `product_id`=:stdprdctid and `user_id` = :stduserid";

    $stmt = $conn->prepare($update_query);
    $stmt->bindParam(":stdquantity", $quantity);
    $stmt->bindParam(":stdprdprice", $productprice);
    $stmt->bindParam(":stdprdctid", $product_id);
    $stmt->bindParam(":stduserid", $user_id);
    $stmt->execute();

}

//function to delete cart
function deleteCart($cart_id)
{
    global $conn;

    $update_query = "delete from `cart_product` where `cartid`=:stdid";

    $stmt = $conn->prepare($update_query);  # send template to the server
    $stmt->bindParam(":stdid", $cart_id);
    $stmt->execute();  # true means that the query exectued by the database successfully

}

//function to save totalprice of all carts 
function deleteAllCarts($user_id)
{
    global $conn;

    $delete_query = "delete from `cart_product` where `user_id`=:user_id";

    $stmt = $conn->prepare($delete_query);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
}

//function to select all products
function selectProducts()
{
    global $conn;

    $select_query = "select * from `products`";

    $select_stmt = $conn->prepare($select_query);

    $select_stmt->execute();

    $products = $select_stmt->fetchAll();

    return $products;
}

