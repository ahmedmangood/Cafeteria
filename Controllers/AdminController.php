<?php 


ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


function getAllUser()
{
    return getAllUserMakeOrder();

}

function filter($user_id){

   return filterorderByUserId($user_id);
}

function getDetalisOfOrder($order_id,$user_id){
    return getOrderDetalis($order_id,$user_id);
}

function filterOrderByUserAndDate($data)
{
    $error = validation($data);
    if(!empty($error)){
// var_dump(!empty($data['user']));
// var_dump($data);
        if(!empty($data['start_date'])&& !empty($data['end_date'])) {
            

            return getOrdersByDate($data['start_date'], $data['end_date']);
        }
        else if(!empty($data['user'])){
              return filterorderByUserId($data['user']);
            }

        else{
            
            return $error;

        }
    }else
        return  getOrdersByDateandUserId($data['start_date'],$data['end_date'],$data['user'] );

}


function ChangeOrderStatus($order_id,$status)
{
    return ChangeStatus($order_id,$status);
}


function totalAmount($user_id)
{
return totalAmountDB($user_id);
}