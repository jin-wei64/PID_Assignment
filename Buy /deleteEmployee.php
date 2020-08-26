<?php
session_start();
$ID = $_SESSION["clientid"];
$_GET["id"] ;
if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (! is_numeric ( $id ))
    die ( "id not a number." );
$sql = <<<multi
    delete from buycar where buyCarId = $id
multi;
// echo $sql;
$link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
mysqli_query($link, "set names utf-8");
mysqli_query($link, $sql);
header("location: buyCar.php?id=$ID");
?>