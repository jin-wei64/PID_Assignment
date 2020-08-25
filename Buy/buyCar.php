<?php
    session_start();
    $clientID = $_GET["id"];
    $_SESSION["clientID"] = $clientID;
    if($clientID == 1){
      $sql = <<<sql
       select buyCarId,productName ,z.quantity ,z.quantity*(select p.price from products as p where productId = z.productId) as total 
       from buycar as z where z.clientid = $clientID 
       sql;
      $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
      mysqli_query($link, "set names utf-8");
      $result = mysqli_query($link , $sql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BuyCar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>BuyCar List
      <a href="addEmployee.php" class="btn btn-outline-info btn-md float-right">New</a>
  </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $row = mysqli_fetch_assoc($result) ) { ?>
      <tr>
        <td><?= $row["productName"] ?></td>
        <td><?= $row["quantity"] ?></td>
        <td><?= $row["total"] ?></td>
        <td>
            <span class="float-right">
                <a href="./editForm.php?id=<?= $row["productId"] ?>" class="btn btn-outline-success btn-sm">Edit</a>
                | 
                <a href="./deleteEmployee.php?id=<?= $row["buyCarId"] ?>" class="btn btn-outline-danger btn-sm">Delete</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    
    </tbody>
  </table>
</div>

</body>
</html>
