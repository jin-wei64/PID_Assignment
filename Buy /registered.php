<?php
    if(isset($_POST["registerBtn"])) {
        $clientAccount = $_POST["clientAccount"];
        $clientPassword = $_POST["clientPassword"];
        $clientName = $_POST["clientName"];
        $clientBday = $_POST["clientBday"];
        $clientEmail = $_POST["clientEmail"];
        $clientPhone = $_POST["clientPhone"];
        $clientSex = $_POST["clientSex"];
        $sql = "                     
        insert into client(clientAccount,clientPassword,clientName,clientBday,clientEmail,clientPhone,clientSex) 
        values('$clientAccount','$clientPassword','$clientName','$clientBday','$clientEmail','$clientPhone','$clientSex')
        ";
        $link = mysqli_connect ( 'localhost', 'root', 'root', 'shopping', 8889 ) or die ( mysqli_connect_error() );
        $result = mysqli_query ( $link, "set names utf8");
        mysqli_query($link, $sql);
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered</title>
</head>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<form method="post" >
<script>

</script>
<div>&nbsp;</div>
<div class = "container">
  <div class="form-group row">
    <label for="clientAccount" class="col-4 col-form-label"> 帳號 ：</label> 
    <div class="col-8">
      <input id="clientAccount" pattern= "[a-zA-Z0-9]{6,}" placeholder="6~12個英文或數字" name="clientAccount" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="clientPassword" class="col-4 col-form-label">密碼：</label> 
    <div class="col-8">
      <input id="clientPassword" pattern= "[a-zA-Z0-9]{6,}" placeholder="6~12個英文或數字" name="clientPassword" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="clientName" class="col-4 col-form-label">姓名：</label> 
    <div class="col-8">
      <input id="clientName" placeholder="" name="clientName" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="clientBday" class="col-4 col-form-label">生日：</label> 
    <div class="col-8">
      <input id="clientBday" pattern="\d{4}-\d{1,2}-\d{1,2}" placeholder="ex:1212-12-12" name="clientBday" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="clientEmail" class="col-4 col-form-label">email：</label> 
    <div class="col-8">
      <input id="clientEmail" pattern= "\w+([.-]\w+)*@\w+([.-]\w+)+" name="clientEmail" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="clientPhone" class="col-4 col-form-label">聯絡電話：</label> 
    <div class="col-8">
      <input id="clientPhone" pattern= "09\d{8}" name="clientPhone" type="text" class="form-control" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">性別</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="clientSex" id="clientSex_0" type="radio" class="custom-control-input" value="1" required> 
        <label for="clientSex_0" class="custom-control-label">男</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="clientSex" id="clientSex_1" type="radio" class="custom-control-input" value="2" required> 
        <label for="clientSex_1" class="custom-control-label">女</label>
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="registerBtn" type="submit" class="btn btn-primary">register</button>
    </div>
  </div>
</div>
</form>

</body>
</html>