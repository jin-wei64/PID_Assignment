<?php
session_start();
$account = $_SESSION["account"];
$clientid =  $_SESSION["clientid"];
// echo $clientid;
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (! is_numeric ( $id ))
    die ( "id not a number." );
$sql = <<<multi
    select * from products where productId = $id
multi;
$link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
mysqli_query($link, "set names utf-8");
$result = mysqli_query($link , $sql);
$row = mysqli_fetch_assoc ( $result );
if(isset($_POST["okBtn"])){
    if($account == ""){
        header("location:login.php");
        exit();
    }
    $productId = $row["productId"];
	$productName = $row["productName"];
	$quantity = $_POST["quantity"];
    $buycarsql= "insert into buycar (clientid,productId,productName,quantity) values ('$clientid','$productId','$productName','$quantity') ";
	mysqli_query($link,$buycarsql);
	header("location:index.php?id=$account");
	exit();
}
if(isset($_POST["indexBtn"])) {
    header("location:index.php?id=$account");
	exit();
}   




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method = "post">
    <h3><?= $row["productName"] ?></h3>
        <p>ID : <?= $row["productId"]?></p>   
        <p>價格 : <?= $row["price"] ?><p>
        <p>庫存 : <?= $row["inStock"] ?><p>
    <input pattern= "^[1-9]\d*|0$." type ="text" name = "quantity" required  >
    <button class="btn btn-outline-success btn-sm ryu" name = "okBtn">加入購物車</button> 
</form>
<form method = "post">
<button name = "indexBtn" class="btn btn-outline-info btn-md float-right">取消</button>   
</form>
</body>
</html>