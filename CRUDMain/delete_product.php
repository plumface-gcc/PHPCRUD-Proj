<?php
require_once('database.php');

// Get IDs
$product_id = filter_input(INPUT_POST, 'product_id_hidden', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id_hidden', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($product_id != false && $category_id != false) {
    $query = "DELETE FROM products
              WHERE productID = :product_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>