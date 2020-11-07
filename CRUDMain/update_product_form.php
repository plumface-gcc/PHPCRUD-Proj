<?php

// Importing these things so we can use 

$category_id = filter_input(INPUT_POST, 'category_id_hidden', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_POST, 'product_id_hidden', FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$name = filter_input(INPUT_POST, 'name');
$codeInput = filter_input(INPUT_POST, 'code');
$name = filter_var($name, FILTER_SANITIZE_STRING);
$codeInput = filter_var($codeInput, FILTER_SANITIZE_STRING);

require('database.php');

?>

<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<!-- the body section -->
<body>
<main>

	<h1>Update Product</h1>
	<form action="update_product.php" method="post" id="update_product_form">
	
	<div class="form-group">
		<input type="hidden" name="product_id_hidden" value="<?php echo $product_id; ?>">
	</div>
	
	<div class="form-group">
	<div id="productform">
		<h5>Category: </h5>
		<?php 
		if (isset($category_error) && $category_error != '')
		{
			?><h5 class='text-warning'><?php echo $category_error; ?></h4>
		<?php } ?>
		<input class="form-control" type="text" name="category" id="category" value="<?php echo htmlspecialchars($category_id); ?>">

		<h5>Code: </h5>
		<?php 
		if (isset($code_error) && $code_error != '')
		{
			?><h5 class='text-warning'><?php echo $code_error; ?></h4>
		<?php } ?>
		<input class="form-control" type="text" name="code" id="code" value="<?php echo htmlspecialchars($codeInput); ?>">
		
		<h5>Name: </h5>
		<?php 
		if (isset($name_error) && $name_error != '')
		{
			?><h5 class='text-warning'><?php echo $name_error; ?></h4>
		<?php } ?>
		<input class="form-control" type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
		
		<h5>List Price: </h5>
		<?php 
		if (isset($price_error) && $price_error != '')
		{
			?><h5 class='text=warning'><?php echo $price_error; ?></h4>
		<?php } ?>
		<input class="form-control" type="text" name="price" id="price" value="<?php echo htmlspecialchars($price); ?>">
		<div id="mybutton">
		<input class="btn btn-primary" type="submit" value="Update">
		</div>
	</div>
	</div>
</main>
</body>
</html>