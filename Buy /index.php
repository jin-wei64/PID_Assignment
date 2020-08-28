<?php
session_start();
$account = $_GET["id"];
$_SESSION["account"] = $account ;
$link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
mysqli_query($link, "set names utf-8");
$acoountId = "select clientid from client where clientAccount = '$account' ; ";
$IDresult = mysqli_query($link , $acoountId);
$IDrow = mysqli_fetch_assoc ( $IDresult );
$clientid = $IDrow["clientid"];
$_SESSION["clientid"] = $clientid ;
$sqlStatement = <<<multi
select * from products;
multi;
$result = mysqli_query($link, $sqlStatement);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>首頁</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>首頁
      <?php if(isset($account)){ ?>  
        <a href="login.php?id=logout" class="btn btn-outline-info btn-md float-right">登出</a>
        <a href="buyCar.php?id=<?=$clientid?>" class="btn btn-outline-info btn-md float-right">購物車</a>
        <a href="order.php?id=<?=$account?>" class="btn btn-outline-info btn-md float-right">歷史訂單</a>
      <?php } else {?>
      <a href="login.php" class="btn btn-outline-info btn-md float-right">登入</a>
      <?php } ?>
      
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
                <a id= "buycar" href="./productdata.php?id=<?= $row["productId"] ?>" class="btn btn-outline-success btn-sm ryu">查看詳情</a>
            </span>
        </td>
      </tr>
    <?php } ?>
    
    </tbody>
  </table>
</div>
</body>
<script> 
</script>
</html>
