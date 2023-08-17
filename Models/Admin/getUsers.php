<?php 

// include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
function getAllUsers() {
    $conn = connect();
    $stmt = $conn->prepare("SELECT * FROM users");
    
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $users;
}
// getAllUsers();
