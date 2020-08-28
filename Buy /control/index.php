<?php 
    require_once ("config.php");
    $link = mysqli_connect($dbhost ,$dbuser ,$dbpass ,$dbname ,8889) or die(mysqli_connect_error());
    $sqlCommand = <<<sqlQuery
                    select * from client;
                    sqlQuery;
    $result = mysqli_query($link ,$sqlCommand);
    $id = $_GET["id"];
    $sql = "select * from client where clientid = $id";
    $ordersql ="select count(clientid) as details from orders where clientid= $id" ;
    $client = mysqli_query($link ,$sql);
    $clientRow = mysqli_fetch_assoc($client);
    $orderResult = mysqli_query($link ,$ordersql);
    $orderRow = mysqli_fetch_assoc($orderResult);
    if(isset($_GET["stop"])) {
      $get =$_GET["stop"];
      $getsql = " select status from client where clientid = $get ;" ;
      $getRow = mysqli_fetch_assoc(mysqli_query($link ,$getsql));
      if($getRow["status"] ==1 ){
        $open = "update client set `status` = 0 where clientid =$get;";
        mysqli_query($link,$open) ;
        header("location:index.php");
      }
      else{
        $stop = "update client set `status` = 1 where clientid =$get; ";
        mysqli_query($link,$stop) ;
        header("location:index.php");
      }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client control</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Client List
      <a href="products/index.php" class="btn btn-outline-info btn-md float-right">products</a>
      <a href="../login.php" class="btn btn-outline-info btn-md float-right">登出</a>
  </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ClientID</th>
        <th>ClientName</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php while ( $row = mysqli_fetch_assoc($result) ) { ?>
      <tr>
        <td><?= $row["clientid"] ?></td>
        <td><?= $row["clientName"] ?></td>
        <td>
            <span class="float-right">
                <a href="index.php?id=<?= $row["clientid"]?>" class="ryu btn btn-outline-dark btn-sm">ClientProfile</a>
                | 
                <?php if ($row['status'] == 1 ) {?>
                  <a  name = "open" href="index.php?stop=<?= $row["clientid"]?>" class="btn btn-outline-danger btn-sm">Stopping...</a>
                <?php } else { ?>
                  <a  name = "stop" href="index.php?stop=<?= $row["clientid"]?>" class="btn btn-outline-success btn-sm">opening...</a>
                <?php }?>
            </span>
        </td>
      </tr>
    <?php } ?>
  
    <!-- 對話盒 -->
    <div id="newsModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h2>clientID : <?= $clientRow["clientid"] ?></h2><br>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form>
                          <div class="form-group">
                              <label >
                                  <span class="glyphicon glyphicon-bullhorn"></span>
                                  <h3>ClientName : <?= $clientRow["clientName"] ?></h3>
                              </label>
                              <label >
                                  <span class="glyphicon glyphicon-bullhorn"></span>
                                  <h2>clientAccount : <?= $clientRow["clientAccount"] ?></h2><br>
                              </label>
                              <label >
                                  <span class="glyphicon glyphicon-bullhorn"></span>
                                  <h2>clientEmail : <?= $clientRow["clientEmail"] ?></h2><br>
                              </label>
                              <label >
                                  <span class="glyphicon glyphicon-bullhorn"></span>
                                  <h2>clientPhone : <?= $clientRow["clientPhone"] ?></h2><br>
                              </label>
                              <label >
                                  <span class="glyphicon glyphicon-bullhorn"></span>
                                  <h2>Orders : <?= $orderRow["details"] ?></h2><br>
                              </label>
                          </div>   
                      </form>
                  </div>
                  <div class="modal-footer">
                          <div class="pull-right">
                              <a 
                                href = "index.php"
                                type="button"
                                id="cancelButton"
                                class="btn btn-default"
                                >
                              <span class="glyphicon glyphicon-remove"></span> OK
                              </a>
                              <a 
                                href = "../order.php?order=<?=$clientRow["clientAccount"]?>"
                                type="button"
                                id="cancelButton"
                                class="btn btn-default"
                                >
                              <span class="glyphicon glyphicon-remove"></span> 訂單
                              </a>
                          </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- /對話盒 -->
  
    </tbody>
  </table>
</div>
</body>
<script>
<?php if (isset($_GET["id"])) { ?>
      $("#newsModal").modal({backdrop:"static"});

<?php }?>
</script>
</html>