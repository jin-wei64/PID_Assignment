<?php
if(isset($_POST['registered'])){
    header("location: registered.php");
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
      <input id="Account" name="Account" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-4 col-form-label">Password</label> 
    <div class="col-8">
      <input id="password" name="password" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">登入</button>
      <button name="registered" type="submit" class="btn btn-primary">註冊</button>
    </div>
  </div>
</div>
</form>
</body>
</html>