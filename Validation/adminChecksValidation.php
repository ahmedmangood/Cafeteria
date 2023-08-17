<?php 
$error=[];

function validationForEmpty($input,$inputName,&$error):bool
{
    if(empty($input)){
        $error[$inputName]="$inputName is required";
        return false;
    }
    return true;
}

function validationForStartDate($start_date,&$error):bool
{
    return validationForEmpty($start_date,"Date From",$error);
   
}

function validationForEndDate($end_date,&$error):bool
{
  return  validationForEmpty($end_date,"Date To",$error);

}
function validationForUser($user,&$error):bool
{
  return  validationForEmpty($user,"User",$error);

}


function validation($data) :array
{
    global $error;
    validationForStartDate($data['start_date'],$error);
    validationForEndDate($data['end_date'],$error);
    validationForUser($data['user'],$error);

    return $error;
}

