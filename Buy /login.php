<?php
  session_start();
  if (isset($_GET["logout"]))
  {
    header("Location: login.php");
    exit();
  }
  $account = $_POST["Account"];
  $password = $_POST["password"];
  if(isset($_POST['user'])){
    
    if($account == "ryu666" && $password == "xd9999521"){
      header("location:control/index.php");
    }
    elseif($account == "" && $password == ""){
      header("location:login.php");
    }
    else{
      echo "您並非使用者";
    }
  }
  $link = mysqli_connect("localhost", "root", "root", "shopping", 8889);
  mysqli_query($link, "set names utf-8");
  $stop= "select clientid from stopClient ;";
  $stopRow = mysqli_fetch_assoc(mysqli_query($link,$stop));
  $account = $_POST["Account"];
  $password= $_POST["password"];
  if(isset($_POST['submit'])){
    
    
    $sqlAccount = <<<multi
    select clientid,clientAccount , clientPassword ,status from client where clientAccount = '$account' ;
    multi;
    $Accountresult = mysqli_query($link, $sqlAccount);
    $Accountrow = mysqli_fetch_assoc($Accountresult);
    if ($Accountrow["clientAccount"] == $account && $Accountrow["clientPassword"] == $password){
      $_SESSION["account"] = $account ;
      if ($Accountrow["status"] ==1) {
        echo "";
      }
      else{
        header("location:index.php?id=$account");
      }
    }
    else {
        echo "password or account is error";
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
<form method="post">
<div>&nbsp</div>
<div class = "container">
  <div class="form-group row">
    <label for="Account" class="col-4 col-form-label">Account</label> 
    <div class="col-8">
      <input  id="Account" name="Account" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-4 col-form-label">Password</label> 
    <div class="col-8">
      <input require  id="password" name="password" type="text" class="form-control" required>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-outline-info btn-md float-right"  >登入</button>
      <a href = "registered.php" name="registered" class="btn btn-outline-info btn-md float-right"   >註冊</a>
      <button  name="user" type="submit" class="btn btn-outline-info btn-md float-left"  >使用者登入</button>
      <a href = "index.php" name="index" type="submit" class="btn btn-outline-info btn-md float-right"   >首頁</a>
    </div>
  </div>
</div>
</form>
</body>
<script>
if(<?=$Accountrow["status"] ?> == 1){
  alert("帳號已被停用");
}


</script>
</html>