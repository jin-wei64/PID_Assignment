<?php
session_start();
    $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
    mysqli_query($link, "set names utf-8");
    $account = $_SESSION["account"];
    $clientid=$_SESSION["clientid"];
    if(is_numeric($_GET["id"])){
        $orderSql = "insert into orders(clientid)values('$clientid')";
        mysqli_query($link,$orderSql);
        $lastorder = "select * from orders where clientid = $clientid order by orderId desc limit 0,1";
        $row =mysqli_fetch_assoc (mysqli_query($link,$lastorder));
        $lastorderID = $row["orderId"];
        $sql = <<<sql
            select buyCarId, productId ,z.quantity ,z.quantity*(select p.price from products as p where productId = z.productId) as totalprice 
            from buycar as z where z.clientid = $clientid ;
        sql;
        $result = mysqli_query($link,$sql);
        while ( $buycar = mysqli_fetch_assoc ($result) ){
            $productId = $buycar["productId"];
            $quantity = $buycar["quantity"];
            $totalprice = $buycar["totalprice"];
            $orderdetails = "insert into orderdetails(orderId , productId , quantity ,totalprice)values('$lastorderID','$productId','$quantity','$totalprice ') ;";
            mysqli_query($link,$orderdetails);
        }
        $orderdetailsSql = "select e.orderId,e.productId,a.productName,e.quantity,e.totalprice ,f.time from orderdetails e 
        JOIN products a on e.productId = a.productId 
        JOIN orders f on e.orderId = f.orderId where f.orderId = $lastorderID" ; 
        $orderdetailsview= mysqli_query($link,$orderdetailsSql);
        $a = "select p.productId ,p.inStock-o.quantity as instock  
        from orderdetails as o JOIN products p 
        on p.productId = o.productId 
        where p.productId = o.productId  and o.orderId = '$lastorderID' ";
        $b = mysqli_query($link,$a);
        while ( $c = mysqli_fetch_assoc($b) ){
          $p = $c['productId'];
          $instock = $c['instock'];
          $update = "update products set inStock = $instock  where productId = $p";
          mysqli_query($link,$update);
        }

   }
    if(!is_numeric($_GET["id"])){
          $orderdetailsSql = "select e.orderId,e.productId,a.productName,e.quantity,e.totalprice, f.time from orderdetails e 
          JOIN products a on e.productId = a.productId 
          JOIN orders f on e.orderId = f.orderId where f.clientid = $clientid order by f.time DESC" ; 
          $orderdetailsview= mysqli_query($link,$orderdetailsSql); 
    }
    if(isset($_GET["order"])){
      $Getaccount = $_GET["order"];
      $orderdetailsSql = "select f.clientid, e.orderId,e.productId,a.productName,e.quantity,e.totalprice, f.time 
      from orderdetails e 
      JOIN products a on e.productId = a.productId 
      JOIN orders f on e.orderId = f.orderId 
      JOIN client c on f.clientid = c.clientid 
      where c.clientAccount = '$Getaccount' order by f.orderId DESC
      " ; 
      $orderdetailsview= mysqli_query($link,$orderdetailsSql); 
      }

   
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
<?php if(isset($_GET["order"])) { ?>
  <h2><?= $_GET["order"]?>的訂單
      <a href="control/index.php" class="btn btn-outline-info btn-md float-right">控制頁</a>
  </h2>
<?php } else { ?>
  <h2><?= is_numeric($_GET["id"]) ? "本次購買項目":"歷史紀錄" ?>
      <a href="index.php?id=<?=$account?>" class="btn btn-outline-info btn-md float-right">首頁</a>
  </h2>
<?php } ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>OrderNuber</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Time</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $Odrow = mysqli_fetch_assoc($orderdetailsview) ) { ?>
      <tr>
        <td><?= $Odrow["orderId"] ?></td>
        <td><?= $Odrow["productName"] ?></td>
        <td><?= $Odrow["quantity"] ?></td>
        <td><?= $Odrow["totalprice"] ?></td>
        <td><?= $Odrow["time"] ?></td>
        <?php $a += $Odrow["totalprice"] ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <h3>總金額： <?=  $a ?></h3>
</div>
</body>
</html>