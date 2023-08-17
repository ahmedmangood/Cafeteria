<?php
$title="My Carts";
// include '../layout/head.php';
// include "../Controllers/AdminController.php";
// include "../Models/AdminOrder.php";
function render_carts_admin($products, $carts, $totalcarts)
{
    $users= getAllUser();
    /*first divide our page to two columns the sidebar and the carts */
    echo "
    <main>
        <div class='row h-100 mr-0'>
            <div class='col-xl-4 col-md-5 col-sm-6'><div class='sidebar'>
                <h4 class='mycarts bg-light d-flex justify-content-center'>My Carts<span class='cartsnum'>" . sizeof($carts) . "</span></h4>";
                    echo " 
                    <div class='mx-auto w-50 '>
                    <form action='AdminAddToCart.php' method='POST' >
                    <select id='user' name='user_id'>"
                   ;
                    foreach($users as $user){
                        echo "<option value ='";
                        echo $user['id']; 
                        echo"'>"; echo $user['username']; echo"</option> 
                        
                        ";
                    }
                    echo "</select>
                    </div>
                    ";
                echo"<div class='row justify-content-center m-0' style='height: 40vh;width: 100%;align-items: center; '>
                   <div id='row1'>
                     <div class='line-numbers'>
                            <span></span>
                        </div>
                        <textarea placeholder='write here the notes you need...'></textarea>
                        </div>
                        <button class='btn btn-danger savebtn' onclick='savenotes({$_SESSION['user']['id']})'><i class='fa-solid fa-chevron-right'></i></button>
                        <div id='row2'>";
                        if(sizeof($totalcarts) > 0){
                            echo "<pre id=''>".$totalcarts[0]["notes"]."</pre>";
                        }else{
                            echo "You don't have any cart";
                        }
                            
                    echo "</div>
                    </div>";
                        if(sizeof($totalcarts) > 0){
                            echo "<span class='totalprice'>Total Price: ".$totalcarts[0]["total_price"].' EGP'."</span>";
                        }else{
                            echo "<span class='totalprice'>Total Price: 0 EGP </span>";
                        }
                    echo "<div class='row align-items-center justify-content-center mb-5 w-100'>";
                        echo"<input type='submit' class='btn btn-primary' value='Order Now'>
                        </form>
                        </div>
                </div>
            </div>
            <div class='col-xl-8 col-md-7 col-sm-6'>
                <div class='container pt-5'>
                    <div class='row' style='justify-content: center;height: 100%;align-items: center;'>";
                        //three columns of carts
                        if (sizeof($carts) > 0) {
                            foreach ($carts as $cart) {
                                foreach ($products as $product) {
                                    if ($product['id'] === $cart['product_id']) {
                                        echo "
                                        <div class='col-xl-4 col-md-6 col-sm-12 '>
                                            <div class='card'>
                                                <div class='card-img'>
                                                    <img src='../assets/imgs/{$product["image"]}'class='card-img-top' alt='product image'>
                                                    <div class='cardcontroller'>
                                                        <button class='btn btn-increment w-15' onclick='incrementquantity({$product["quantity"]},{$product["id"]},{$cart['user_id']},{$product['price']})'>
                                                            <i class='fa-solid fa-plus'></i>
                                                        </button>
                                                        <span class='card-quantity w-25' id='{$product["id"]}'>";
                                        if ($product["quantity"] > 0) {
                                            echo "{$cart["quantity"]}";
                                        } else {
                                            echo "0";
                                        };
                                        echo "</span>
                                                <button class='btn btn-decrement w-15' onclick='decrementquantity({$product["id"]},{$cart['user_id']},{$product['price']})'>
                                                    <i class='fa-solid fa-minus'></i>
                                                </button>
                                            </div>";
                                        if ($product["quantity"] == 0) {
                                            echo "<div class='unavailable pro{$product["id"]}'>
                                                    <span>Unavailable</span>
                                                </div>";
                                        } else {
                                            echo "<div class='available pro{$product["id"]}'>
                                                    <span>Available</span>
                                                </div>";
                                        };
                    
                                        echo "</div>
                                                <div class='card-body p-0 pb-3'>
                                                    <div class='card-header justify-content-around align-items-center row flex-row mb-4'>
                                                        <h5 class='card-title'>{$product["name"]}</h5>
                                                        <span class='card-price' id='prod{$product["id"]}price'>{$cart["price"]} EGP</span>
                                                    </div>
                                                
                                                <button class='btn  rmv-btn' onclick='removecart({$cart["cartid"]})'><i class='fa-regular fa-trash-can'></i></button>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                }
                            }
                            
                        } else {
                            echo "<div class='emptycart'>
                                <i class='fa-solid fa-cart-plus'></i>
                                <p>You may need to add something to cart</p>
                            </div>";
                        }
                echo"</div>
                </div>
            </div>
        </div>
        <div class='popupscreen'>
        <div class='popupbox'>
            <p class='warning-mssg'>Are you sure you want to delete this card?</p>
            <div class='warningbtns'>
                <button class='popbtn btn btn-primary'>cancle</button>
                <button class='popbtn btn btn-danger' >ok</button>
            </div>
        </div>
    </main>
    <script src='script.js'></script>";

}   
