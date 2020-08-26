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
            $orderdetailsview = mysqli_query($link,$orderdetails);
        }
        $orderdetailsSql = "select e.orderId,e.productId,a.productName,e.quantity,e.totalprice from orderdetails e 
        JOIN products a on e.productId = a.productId 
        JOIN orders f on e.orderId = f.orderId where f.orderId = $lastorderID" ; 
        $orderdetailsview= mysqli_query($link,$orderdetailsSql);
        
        // header("location:buynet.php?id=$account") ;
   }
   else{
        $orderdetailsSql = "select e.orderId,e.productId,a.productName,e.quantity,e.totalprice from orderdetails e 
        JOIN products a on e.productId = a.productId 
        JOIN orders f on e.orderId = f.orderId where f.clientid = $clientid" ; 
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
  <h2><?= is_numeric($_GET["id"]) ? "本次購買項目":"歷史紀錄" ?>
      <a href="buynet.php?id=<?=$account?>" class="btn btn-outline-info btn-md float-right">首頁</a>
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
    <?php while ( $Odrow = mysqli_fetch_assoc($orderdetailsview) ) { ?>
      <tr>
        <td><?= $Odrow["productName"] ?></td>
        <td><?= $Odrow["quantity"] ?></td>
        <td><?= $Odrow["totalprice"] ?></td>
        <?php $a += $Odrow["totalprice"] ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <h3>總金額： <?=  $a ?></h3>
</div>
</body>
</html>