<?php

function imageValid()
{

  global $product_updated;

  //**To Sure That Input File Is Not Empty.
  //**If Input File Is Empty Set The The Old Image.

  if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // File was uploaded successfully
    $oldImage = "../../" . $product_updated['image'];
    // Delete the image file from the server
    if (file_exists($oldImage)) {
      unlink($oldImage);
    }
    $image = "assets/products/" . $_FILES['image']['name'];
    // Process the file
  } else {
    // File upload error occurred
    // $image =  substr(, 5);

    $image =   $product_updated['image'];
  }

  return $image;
}

//*Add Product
function AddProduct($name, $image, $price, $quantity, $category_id)
{
  $error = [];

  //Store the product information in the database
  $data = [
    'name' => $name,
    'image' => $image,
    'price' => $price,
    'quantity' => $quantity,
    'category_id' => $category_id,
  ];
  $error = validation_Product($data);


  if (empty($error)) {
    // AddCategoryQuery($data);
    AddProductQuery($name, $image, $price, $quantity, $category_id);
  }
  return $error;
}

//*Update Product
function updateProduct($product_id, $name, $image, $price, $quantity, $category_id)
{
  $error = [];
  $data = [
    'name' => $name,
    'image' => $image,
    'price' => $price,
    'quantity' => $quantity,
    'category_id' => $category_id,
  ];
  $error = validation_Product($data);
  if (empty($error)) {
    UpdateProductQuery($product_id, $name, $image, $price, $quantity, $category_id);
  }
  return $error;
}

//*Delete Product
function DeleteProduct($id)
{
  DeleteProductQuery($id);
}
