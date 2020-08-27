<?php
require("connDB.php");
$sqlStatement = <<<multi
select * from products;
multi;
// "select * from employee";
$result = mysqli_query($link, $sqlStatement);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Products List
      <a href="addEmployee.php" class="btn btn-outline-info btn-md float-right">New</a>
  </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>In stock</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $row = mysqli_fetch_assoc($result) ) { ?>
      <tr>
        <td><?= $row["productId"] ?></td>
        <td><?= $row["productName"] ?></td>
        <td><?= $row["price"] ?></td>
        <td><?= $row["inStock"] ?></td>
        <td>
            <span class="float-right">
                <a href="./editForm.php?id=<?= $row["productId"] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                | 
                <a href="./deleteEmployee.php?id=<?= $row["productId"] ?>" class="btn btn-outline-danger btn-sm">Delete</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    
    </tbody>
  </table>
</div>

</body>
</html>
