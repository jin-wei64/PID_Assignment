<?php
    session_start();
    $clientaccount = $_GET['id'];

    $nameSql = "select clientName,clientid from client where clientAccount = '$clientaccount'";
    $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
    mysqli_query($link, "set names utf-8"); 
    $name =  mysqli_fetch_assoc(mysqli_query($link,$nameSql));

    $clientid = $name['clientid'];

    $sql = "select * from orders where clientid = $clientid ";
    $result =  mysqli_query($link,$sql);  
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
  <h2><?= $name['clientName']  ?>的訂單<a href="index.php" class="btn btn-outline-info btn-md float-right">控制頁</a></h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>OrderID</th>
        <th>time</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $row = mysqli_fetch_assoc($result) ) { ?>
      <tr>
        <td><?= $row["orderId"] ?></td>
        <td><?= $row["time"] ?></td>
        <td>
            <span class="float-right">
                <a href="orderdetails.php?id=<?= $row["orderId"]?>" class="ryu btn btn-outline-dark btn-sm">orderdetails</a>
            </span> 
        </td>       
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>