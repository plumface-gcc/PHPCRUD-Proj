<?php

// Virutally the same as insert_product, just a new SQL query and some other minor things

$category_id = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id_hidden', FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$name = filter_input(INPUT_POST, 'name');
$codeInput = filter_input(INPUT_POST, 'code');
$name = filter_var($name, FILTER_SANITIZE_STRING);
$codeInput = filter_var($codeInput, FILTER_SANITIZE_STRING);
$category_error = '';
$code_error = '';
$name_error = '';
$price_error = '';

if ($category_id <= 0 OR $category_id >= 4)
{
	$category_error = "Please enter a valid category between 1 and 3.";
}

if ($price < 0 OR $price > 50000)
{
	$price_error = "Please enter a price greater than 0 and less than 50000.";
}

if (empty($code_error))
{
	$code_error = "Please enter a category number.";
}

if (empty($name))
{
	$name_error = "Please enter a name.";
}

if (empty($price))
{
	$price_error = "Please enter a price.";
}

switch (TRUE) // Going to try a switch clause here, seems like it would be more efficient
{
		
	case ($price_error != ''):
	case ($category_error != ''):
	case ($name_error != ''):
	case ($code_error != ''):
		include('update_product_form.php');
		exit();
		break;
		
	default:
		require('database.php');
	
		$query = 'update products set categoryID = :category_id, productCode = :code, productName = :name, listPrice = :price where productID = :product_id'; // Query to update selected product
		
		$statement = $db->prepare($query);
		$statement->bindValue(':price', $price);
		$statement->bindValue(':name', $name, PDO::PARAM_STR_CHAR);
		$statement->bindValue(':code', $codeInput, PDO::PARAM_STR_CHAR);
		$statement->bindValue(':product_id', $product_id);
		$statement-> bindValue(':category_id', $category_id);
		
		$statement->execute();
		$statement->closeCursor();
		
		include('index.php'); // Redirecting 	
		break;
		
}
	
?>	