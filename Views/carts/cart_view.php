<?php
$title = "My Carts";
include "../layout/head.php";

function render_carts($products, $carts, $totalcarts)
{
    global $users;
    /*first divide our page to two columns the sidebar and the carts */
    echo "
    <div id='mySidebar' class='sidebar'>
        <div class='sidebar-head'>
            <span class='mycarts'>My Carts<span class='cartsnum'> " . sizeof($carts) . "</span></span>
        </div>
        <div class='row sidebar-body'>
            <div id='writenotes'>
                <div class='line-numbers'>
                    <span></span>
                </div>
                <textarea placeholder='write here the notes you need...'></textarea>
            </div>
            <button class='btn savebtn' onclick='savenotes({$_SESSION["user"]["id"]})'>Save</button>
            <div id='savednotes'>";
    if (sizeof($totalcarts) > 0) {
        echo "<pre id=''>" . $totalcarts[0]["notes"] . "</pre>";
    } else {
        echo "You don't have any cart";
    }
    echo '</div>
        </div>';
    if (sizeof($totalcarts) > 0) {
        echo "<span class='totalprice'>Total Price: " . $totalcarts[0]["total_price"] . " EGP" . "</span>";
    } else {
        echo "<span class='totalprice'>Total Price: 0 EGP </span>";
    }
    echo "
            <button class='btn orderbtn' onclick='createorder({$_SESSION["user"]["id"]})'>Order Now</button>
    </div>
    <button class='openbtn sidebarbtn' onclick='Open_Close_Nav()'><i class='fa-solid fa-circle-chevron-right'></i></button>  
    <div id='main'>
        <div class='container pt-5'>
            <div class='row container_cards_user cards-row mx-auto'>";
    if (sizeof($carts) > 0) {
        foreach ($carts as $cart) {
            foreach ($products as $product) {
                if ($product["id"] === $cart["product_id"]) {
                    echo "
                        <div class='col-xl-4  col-md-6 col-sm-12'>
                          <div class='card_container p-0 overflow-hidden'>
                              <div class='card-img'>
                                    <img src='../{$product["image"]}'class='card-img-top' alt='product image'>
                                    <div class='cardcontroller'>
                                        <button class='btn btn-increment w-15' onclick='incrementquantity({$product["quantity"]},{$product["id"]},{$cart["user_id"]},{$product["price"]})'>
                                            <i class='fa-solid fa-plus'></i>
                                        </button>
                                        <span class='card-quantity w-25' id='{$product["id"]}'>";
                    if ($product["quantity"] > 0) {
                        echo "{$cart["quantity"]}";
                    } else {
                        echo "0";
                    };
                    echo "          </span>
                                        <button class='btn btn-decrement w-15' onclick='decrementquantity({$product["id"]},{$cart["user_id"]},{$product["price"]})'>
                                            <i class='fa-solid fa-minus'></i>
                                        </button>
                                    </div>";
                    if ($product["quantity"] == 0) {
                        echo '      <div class="unavailable pro{$product["id"]}">
                                        <span>Unavailable</span>
                                    </div>';
                    } else {
                        echo '  <div class="available pro{$product["id"]}">
                                        <span>Available</span>
                                    </div>';
                    };

                    echo "      </div>
                                <div class='card-body p-0'>
                                    <div class='card-header'>
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
        echo '      <div class="emptycart">
                        <i class="fa-solid fa-cart-plus"></i>
                        <p>You may need to add something to cart</p>
                    </div>';
    }
    echo "
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
    </div>
    <script src='script.js'></script>";
    include '../layout/footer.php';
}
