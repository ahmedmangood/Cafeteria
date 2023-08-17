<?php 

function getUserName($user_id)
{
    global  $conn ;
    $query = "select `username` from users where id =$user_id";
    $result = $conn->query($query);
//    var_dump($result->fetch());
    return $result->fetch();
}
function getAllUserMakeOrder()
{
    global $conn ;
    $query= "SELECT `id`,`username` FROM users where role =0"; 
   $result = $conn->query($query);
    return  $result->fetchAll();
}

function filterorderByUserId($user_id)
{
global  $conn ;
$query = "select * from orders where user_id = :user_id";
$result = $conn->prepare($query);
$result->bindParam(':user_id',$user_id);
$result->execute();
return $result->fetchAll();

}


function getOrderDetalis($order_id,$user_id)
{
    global  $conn;
      $query = "Select * from orders_products where  orders_products.`order_id` = :order_id and `user_id` = :user_id";
      $result1 = $conn->prepare($query);
      $result1->bindParam(':order_id',$order_id);
      $result1->bindParam(':user_id',$user_id);
      $result1->execute();
        return $result1->fetchAll() ;
}

function getOrdersByDate($start_date,$end_date)
{
  global  $conn;
  $query = "Select * from orders where  orders.`created_at` between :start_date and :end_date and user_id is not null";
  $result1 = $conn->prepare($query);
  $result1->bindParam(':start_date',$start_date);
  $result1->bindParam(':end_date',$end_date);
  $result1->execute();
    return $result1->fetchAll() ;
}

function getOrdersByDateandUserId($start_date,$end_date,$user_id)
{

    global  $conn;
    $query = "Select * from orders where   orders.`created_at` between :start_date and :end_date and user_id = :user_id ";
    $result1 = $conn->prepare($query);

    $result1->bindParam(':user_id',$user_id);
    $result1->bindParam(':start_date',$start_date);
    $result1->bindParam(':end_date',$end_date);
    $result1->execute();
    return $result1->fetchAll() ;
}


function ChangeStatus($order_id,$status)
{
    global  $conn;
$query= "UPDATE  orders set status =:status where id= :id ";
$result = $conn->prepare($query);
$result->bindParam('id',$order_id);
$result->bindParam('status',$status);
return $result->execute();

}


function totalAmountDB($user_id)
{
    $total_amount=0;
    $userOrders = filterorderByUserId($user_id);
    foreach($userOrders as $order )  {
        $total_amount +=$order['total_price'];
    }
    return $total_amount;
}