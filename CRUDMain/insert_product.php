<?php
// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

//Retrieve and sanitize the codeinput
$codeInput = filter_input(INPUT_POST, 'code');
$codeInput = filter_var($codeInput, FILTER_SANITIZE_STRING);

//Retrieve and sanitize the name
$name = filter_input(INPUT_POST, 'name');
$name = filter_var($name, FILTER_SANITIZE_STRING);

$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);


$category_error = '';
$code_error = '';
$name_error = '';
$price_error = '';

// Validate inputs
if ($category_id == null || $category_id == false){
    $category_error = "Please choose a category.";
}

if($codeInput == false){
    $code_error = "Please enter a code";
}

if($name == false){
    $name_error = "Please enter a name";
}

if($price == false){
    $price_error = "Please enter a price";
} else if($price < 0 || $price > 50000){
    $price_error = "Please enter a price between 0 and 50 000 dollars";
}

if($price_error!='' || $name_error!=''  || $code_error!=''  || $category_error!='' ) {
    include('add_product_form.php');
    exit();
} else {
    require_once('database.php');

    // Add the product to the database  
    $query = 'INSERT INTO products
                 (categoryID, productCode, productName, listPrice)
              VALUES
                 (:category_id, :code, :name, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $codeInput);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}
?>