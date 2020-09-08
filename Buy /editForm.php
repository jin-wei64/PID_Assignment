<?php
session_start();
$clientId =$_SESSION["clientid"];
if (isset($_POST["cancelButton"])) {
  header("location: buyCar.php?id=$clientId");
  exit();
}
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (! is_numeric ( $id ))
    die ( "id not a number." );

//echo $sql;
$link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
  mysqli_query($link, "set names utf-8");
if (isset($_POST["editbutton"])) {
  $quantity = $_POST["Quantity"];
  if($quantity <= $_SESSION['instock'] && $quantity > 0 ){
    $sql = <<<multi
      update buycar set 
      quantity='$quantity' 
      where buyCarId = $id;
    multi;
    mysqli_query($link, $sql);
    header("location: buyCar.php?id=$clientId ");
    exit();
  }
  else if ($quantity <= 0){
    echo "<script>alert('請輸入０以上的數'); location.href = 'editForm.php?id=$id';</script>";
  }
  else
    echo "<script>alert('庫存不足'); location.href = 'editForm.php?id=$id';</script>";
  
    
}
else {
  $sql = <<<multi
    select * from buycar where buyCarId = $id
  multi;
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $productName = $row["productName"];
  $product = "select * from products where productName = '$productName ' ";
  $Presult = mysqli_query($link, $product);
  $Prow = mysqli_fetch_assoc($Presult);
  $_SESSION['instock'] = $Prow["inStock"];
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
      <H3><?= $row["productName"] ?></H3>
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">Price</label> 
    <div class="col-8">
      <h3><?= $Prow["price"] ?></h3>
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">庫存</label> 
    <div class="col-8">
      <h3><?= $Prow["inStock"] ?></h3>
    </div>
  </div>
  <div class="form-group row">
    <label for="inStock" class="col-4 col-form-label">Quantity</label> 
    <div class="col-8">
      <input  value = "<?= $row["quantity"] ?>" id="Quantity" name="Quantity" type="text" class="form-control" required>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="editbutton" type="submit" class="btn btn-primary">Edit</button>
      <button name="cancelButton" type="submit" class="btn btn-primary">Cancel</button>
    </div>
  </div>
</form>


</div>

</body>
</html>