<?php  

include_once $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';

// Create User To Database

function createNewUser($email, $password, $username, $image, $role) {

    $conn = connect();
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result['count'] > 0) {
        // email address already exists in the database
        return false;
    } else {
        $stmt = $conn->prepare('INSERT INTO 
                    users (email, password, username, image, role) 
                    VALUES(:email, :password, :username, :image, :role);');
        $stmt->execute(array(
            ':email'    => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':username' => $username,
            ':image'    => $image,
            ':role'     => $role
        ));
        return true;
}
}

function getUserById($id) {
    
    $conn = connect();

    $query = "SELECT * FROM users WHERE id=:id";

    $stmt = $conn->prepare($query);

    $stmt->execute(array( ':id' => $id ));

    $user = $stmt->fetch();

    $conn = null;

    return $user;
}


function CheckIfUserDeleted($userId)
{
    $conn = connect();

    $query = "SELECT id FROM users WHERE id=:userId";

    $stmt = $conn->prepare($query);

    $stmt->execute(array( ':userId' => $userId ));
    // var_dump($stmt->rowCount());
    if($stmt->rowCount()>0)
    {
        return false;
    }
    return true;

}