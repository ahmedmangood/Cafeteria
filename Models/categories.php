<?php

$table = 'categories';

//ADD CATEGORY 
function AddCategoryQuery($data)
{
    global $conn;
    global $table;

    try {
        $query = "INSERT INTO  $table (`id`, `name`) VALUES (:cateId,:cateName)";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);

        $stmt->bindParam(":cateId", $data['id']);
        $stmt->bindParam(":cateName", $data['name']);

        # true --> query executed successfully
        return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//DISPLAY CATEGORY 

function DisplayCategoryQuery()
{
    global $conn;
    global $table;

    try {
        $query = "SELECT * FROM  $table";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// function DisplayCategoryNameByIdQuery($category_id){
//     global $conn;
//     global $table;

//     try {
//         $query = "SELECT `name` FROM  $table WHERE `id` = :category_id ";
//         // var_dump($query);

//         ### prepare query
//         $stmt = $conn->prepare($query);
//         $stmt->execute();
//         $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         return $row;
//     } catch (Exception $e) {
//         echo $e->getMessage();
//     }
// }

//**DISPLAY Categories With Pagination For Admin
function Display_All_Categories_Query_With_Pagination()
{
    global $conn;
    global $table;
    list(
        $currentPage,
        $total_pages,
        $records_per_page, $offset
    ) = pagination_category();
    try {
        // Build the SQL query with LIMIT and OFFSET clauses
        $query = "SELECT * FROM $table LIMIT :limit OFFSET :offset";
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
function pagination_category()
{
    global $conn;
    global $table;

    $query = "SELECT * FROM $table";
    ### prepare query
    $stmt = $conn->prepare($query);
    $stmt->execute();
    //Retrieve the total number of records in the database table 
    $total_records = $stmt->rowCount();
    //Set the number of records to display per page and calculate the total number of pages
    $records_per_page = 5;
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
function printPages_category($total_pages, $currentPage, $ValueSearch)
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

//SELECT CATEGORY BY ID 
function SelectCategoryByIdQuery($category_id)
{
    global $conn;
    global $table;

    try {
        $query = "SELECT `name` FROM  $table WHERE  id =:category_id";;
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":category_id", $category_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row["name"];
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// ----------------------------------------------------------------

//DELETE CATEGORY 
function DeleteCategoryQuery($id)
{
    global $conn;
    global $table;
    // try {
    // alert($id);
    $query = "DELETE FROM  $table WHERE id = :id";
    // var_dump($query);

    ### prepare query
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->rowCount();
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }
}

// ----------------------------------------------------------------

//UPDATE CATEGORY 
function UpdateCategoryQuery($id, $data)
{
    global $conn;
    global $table;
    try {
        $query = "UPDATE  $table SET name = :cateName WHERE id = :id";
        // var_dump($query);

        ### prepare query
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":cateName", $data['name']);
        # true --> query executed successfully
        return $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
