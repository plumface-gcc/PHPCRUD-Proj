<?php

if(!isset($codeInput)){
    $codeInput = '';
}
if(!isset($price)){
    $price = '';
}
if(!isset($name)){
    $name = '';
}

require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<!-- the body section -->
<body>
    <div class="container">
    <header><h1>Product Manager</h1></header>

    <main>
        <h1>Add Product</h1>

        <form action="insert_product.php" method="post"
              id="add_product_form">

            <div class="form-group">
                <label>Category:</label>
                <?php if(isset($category_error) && $category_error != ''){ ?>
                    <h3 class='text-danger'><?php echo $category_error; ?></h3>
                <?php } ?>
                <select class="form-control" name="category_id">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
                </select><br>
            </div>

            <div class="form-group">
                <label for="code">Code:</label>
                <?php if(isset($code_error) && $code_error != ''){ ?>
                    <h3 class='text-danger'><?php echo $code_error; ?></h3>
                <?php } ?>
                <input class="form-control" type="text" name="code" id="code"
                value="<?php echo htmlspecialchars($codeInput); ?>"><br>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <?php if(isset($name_error) && $name_error != ''){ ?>
                    <h3 class='text-danger'><?php echo $name_error; ?></h3>
                <?php } ?>
                <input class="form-control" type="text" name="name" id="name"
                value="<?php echo htmlspecialchars($name); ?>"><br>
            </div>

            <div class="form-group">
                <label for="price">List Price:</label>
                <?php if(isset($price_error) && $price_error != ''){ ?>
                    <h3 class='text-danger'><?php echo $price_error; ?></h3>
                <?php } ?>
                <input class="form-control" type="text" name="price" id="price"
                value="<?php echo htmlspecialchars($price); ?>"><br>
            </div>

            <label>&nbsp;</label>
            <input class="btn btn-primary" type="submit" value="Add Product"><br>
        </form>
        <p><br><a href="index.php">View Product List</a></p>
    </main>
    </div>
</body>
</html>