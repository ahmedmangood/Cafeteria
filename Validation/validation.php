<?php
$error = [];


function validationForEmpty($input, $inputName, &$error): bool
{
    if (empty($input)) {
        $error[$inputName] = "<p class='text-danger font-weight-bold'>*$inputName is required</p>";
    }
    // return true;
    return true;
}


//*Validation for empty Name
function validationForName($firstName, &$error): void
{
    validationForEmpty($firstName, "name", $error);
}

//*Validation for empty Price
function validationForPrice($Price, &$error): void
{
    validationForEmpty($Price, "price", $error);
}

//*Validation for empty quantity
function validationForQuantity($quantity, &$error): void
{
    validationForEmpty($quantity, "quantity", $error);
}

//*Validation for empty category_id
function validationForCategoryId($category_id, &$error): void
{
    validationForEmpty($category_id, "category_id", $error);
}
function validation_Product($data): array
{
    global $error;
    validationForName($data['name'], $error);
    validationForPrice($data['price'], $error);
    validationForQuantity($data['quantity'], $error);
    validationForCategoryId($data['category_id'], $error);
    return $error;
}

function validation_Category($data): array
{
    global $error;
    validationForName($data['name'], $error);
    return $error;
}