<?php
if (isset($_POST["addbutton"])) {
  $productName = $_POST["productName"];
  $price = $_POST["price"];
  $inStock = $_POST["inStock"];
  $sql = <<<multi
    insert into products (productName, price, inStock)
    values ('$productName', '$price', '$inStock');
  multi;
  require("connDB.php");
  mysqli_query($link, $sql);
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add prosuct</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div>&nbsp</div>
<form method="post">
  <div class="form-group row">
    <label for="productName" class="col-4 col-form-label">Name</label> 
    <div class="col-8">
      <input id="productName" name="productName" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">Price</label> 
    <div class="col-8">
      <input id="price" name="price" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="inStock" class="col-4 col-form-label">Quantity</label> 
    <div class="col-8">
      <input id="inStock" name="inStock" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="addbutton" type="submit" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>


</div>

</body>
</html>
