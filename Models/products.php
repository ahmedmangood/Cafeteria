<?php

$table = 'products';

//**ADD PRODUCT 
function AddProductQuery($name, $image, $price, $quantity, $category_id)
{
    global $conn;

    $query = "INSERT INTO `products` (`name`,`image`, price, quantity, category_id) VALUES ( :productName, :productImage, :price, :quantity, :category_id)";

    $stmt = $conn->prepare($query);
    $target = "../../";
    $image_path =  $target . $image;
    // var_dump($_FILES['image']['tmp_name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // Upload the image with the unique name
    $stmt->bindParam(':productName', $name);
    $stmt->bindParam(':productImage', $image);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':category_id', $category_id);
    try {
        $stmt->execute();
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------
//**DISPLAY Newest PRODUCT 8 ITEMS ONLY IN HOME **
function DisplayNewestProductsQuery()
{
    global $conn;

    try {
        $query = "SELECT * FROM `products`  WHERE `quantity` > 0 ORDER BY id ASC LIMIT 8";        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//**DISPLAY ALL PRODUCT * Without *  Pagination For Admin 
function DisplayAllProductsQuery()
{
    global $conn;

    try {
        $query = "SELECT * FROM  `products`";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//**DISPLAY Available Products With Pagination For Admin
function Display_All_Products_Query_With_Pagination()
{
    global $conn;
    list(
        $currentPage,
        $total_pages,
        $records_per_page, $offset
    ) = pagination();
    try {
        // Build the SQL query with LIMIT and OFFSET clauses
        $query = "SELECT * FROM `products` LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}


// ----------------------------------------------------------------
//*Retrieve Product Per Page and calculate number of pages
function pagination()
{
    global $conn;

    $query = "SELECT * FROM  `products`";
    ### prepare query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    //Retrieve the total number of records in the database table 
    $total_records = $stmt->rowCount();
    //Set the number of records to display per page and calculate the total number of pages
    $records_per_page = 8;
    $total_pages = ceil($total_records / $records_per_page);

    // Get the current page number
    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    } else {
        $currentPage = 1;
    }
    // Calculate the offset for the SQL query
    $offset = ($currentPage - 1) * $records_per_page;
    return [
        $currentPage,
        $total_pages,
        $records_per_page, $offset
    ];
}

// ----------------------------------------------------------------
//*Print Page 
function printPages($total_pages, $currentPage, $ValueSearch)
{
    echo "<div class='container_page_num' >";
    if (isset($ValueSearch)) {
        $searchTerm = "&search_term=" . ($ValueSearch);
    } else {
        $searchTerm = "";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $currentPage) {
            echo "<strong class='num_page_active'>$i</strong> ";
        } else {
            echo "<a class='num_page' href='?page=$i$searchTerm'>$i</a> ";
        }
    }
    echo "</div>";
}

// ----------------------------------------------------------------

//**DISPLAY Available Products With Pagination For Users Only
function DisplayAvailableProductsQueryWithPagination()
{
    global $conn;
    list(
        $currentPage,
        $total_pages,
        $records_per_page, $offset
    ) = pagination();
    try {
        // Build the SQL query with LIMIT and OFFSET clauses
        $query = "SELECT * FROM `products` LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//** Search Query  With Pagination */
function search_Product_With_Pagination_Query($ValueSearch)
{
    global $conn;
    list(
        $currentPage,
        $total_pages,
        $records_per_page, $offset
    ) = pagination();
    try {
        // Query the database with the search term
        $query = "SELECT * FROM `products` WHERE `name` LIKE '%$ValueSearch%' LIMIT :limit OFFSET :offset";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            return $row;
        } else {
            echo "<h2 class='my-4' >  No results found for: " . $ValueSearch   . "</h2>";
            return $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//**DISPLAY Available PRODUCT * Without * Pagination
function DisplayAvailableProductsQuery()
{
    global $conn;

    try {
        $query = "SELECT * FROM  `products` WHERE `quantity` > 0";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//*SELECT PRODUCT BY ID 
function SelectProductByIdQuery($id)
{
    global $conn;

    try {
        $query = "SELECT * FROM  `products` WHERE  id =:id";;
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//*Select Image From DataBase */
function selectImageQuery($id)
{
    global $conn;
    // Get the image name from the database
    $query = "SELECT `image` FROM `products` WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $imageName = $stmt->fetchColumn();
    return $imageName;
}

// ----------------------------------------------------------------

//*Delete Product && Delete his image from database and the folder
// function DeleteProductQuery($id)
// {
//     global $conn;
//     try {
//         //Select Image From DataBase
//         $imageName = selectImageQuery($id);
//         $imagePath = '../../' . $imageName;
//         $query = "DELETE FROM `products` WHERE id = :id";
//         ### prepare query
//         $stmt = $conn->prepare($query);
//         $stmt->bindParam(":id", $id);
//         $stmt->execute();
//         // Delete the image file from the server
//         if (file_exists($imagePath)) {
//             unlink($imagePath);
//         } else {
//             echo "Image file not found";
//         }
//         return $stmt->rowCount();
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }

//*Delete Product && Delete his image from database and the folder
function DeleteProductQuery($id)
{
    global $conn;
    //*Check if the product in order_product table 
    $queryIfProductExist = "SELECT * FROM `order_product` WHERE product_id = :id";
    $stmt = $conn->prepare($queryIfProductExist);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    try {
        //Select Image From DataBase
        $imageName = selectImageQuery($id);
        $imagePath = '../../' . $imageName;
        // $query = "DELETE FROM `products` WHERE id = :id";
        $query = "UPDATE  `products` SET quantity = 0  WHERE id = :id";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
// }



// ----------------------------------------------------------------

//**UPDATE PRODUCT 
function UpdateProductQuery($id, $name, $image, $price, $quantity, $category_id)
{
    global $conn;
    try {
        $query = "UPDATE  `products` SET name = :productName ,image=:productImage,price=:price,quantity=:quantity,category_id=:category_id  WHERE id = :id";

        $target = "../../";
        $image_path =  $target . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':productName', $name);
        $stmt->bindParam(':productImage', $image);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(":id", $id);        # true --> query executed successfully
        return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//** Search Query */
function searchProductQuery($ValueSearch)
{
    global $conn;
    try {
        // Query the database with the search term
        $query = "SELECT * FROM `products` WHERE `name` LIKE '%$ValueSearch%' AND `quantity` > 0 ";
        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            return $row;
        } else {
            echo "<h2 class='my-4' >  No results found for: " . $ValueSearch   . "</h2>";
            return $row;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
