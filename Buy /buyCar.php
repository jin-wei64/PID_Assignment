<?php
    session_start();
    $account = $_SESSION["account"];
    $clientID = $_GET["id"];
    // echo $clientID ;
    if(isset($clientID)){
      $sql = "
      select b.buyCarId,p.productName,p.inStock,b.productId ,b.clientId  ,b.quantity*p.price as total,b.quantity, p.price 
      FROM `buycar` as b 
      JOIN products as p 
      on  b.productId = p.productId where b.clientid = '$clientID' ;
      ";
      $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
      mysqli_query($link, "set names utf-8");
      $result = mysqli_query($link , $sql);

    }
    if(isset($_POST["clear"])){
      $deleteBuyCar  = "delete from buycar where clientid = $clientID;";
      mysqli_query($link,$deleteBuyCar);
      header("location:buyCar.php?id=$clientID ");
    } 
    $sum= 0;
    $total= 0;
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
      <a href="index.php?id=<?=$account?>" class="btn btn-outline-info btn-md float-right">首頁</a>
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
                <a href="./editForm.php?id=<?=$row["buyCarId"]  ?>" class="btn btn-outline-success btn-sm">Edit</a>
                | 
                <a href="./deleteProduct.php?id=<?= $row["buyCarId"] ?>" class="btn btn-outline-danger btn-sm">Delete</a>
            </span>
        </td>
      </tr>
      <?php $total += $row["total"]  ?>
      <?php $sum += 1 ?>
    <?php } ?>
    </tbody>
  </table>
  <h3>總金額：<?= $total ?></h3>
  <form method="post">
  <button  id ="clear"name = "clear"class="btn btn-outline-danger float-right">清除購物車</button>
  </form>
  <a id = "OK" href="order.php?id=<?= $clientID ?>" class="btn btn-outline-warning float-right">確認購買</a>
</div>
</body>
<script>
    let a = <?= $sum ?>;
    if(a==0){
      $("#OK").hide();
      $("#clear").hide();
    }
</script>
</html>
