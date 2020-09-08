<?php
    session_start();
    $id = $_GET['id'];
    $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
    mysqli_query($link, "set names utf-8"); 
    $sql = "select * from orderdetails as o JOIN products as p on p.productId = o.productId where orderId = $id ";
    $result =  mysqli_query($link,$sql);  
    $sum = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>


<div class="container">
  <h2><?= $id ?>號訂單明細</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ProductId</th>
        <th>Name</th>
        <th>Quantiyty</th>
        <th>Price</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $row = mysqli_fetch_assoc($result) ) { ?>
      <tr>
        <td><?= $row["productId"] ?></td>
        <td><?= $row["productName"] ?></td>
        <td><?= $row["quantity"] ?></td>
        <td><?= $row["totalprice"] ?></td>    
      </tr>
      <?php $sum +=$row["totalprice"] ;?>
    <?php } ?>
    </tbody>
  </table>
  <h3>總金額：<?= $sum ?></h3>
</div>
</body>
</html>