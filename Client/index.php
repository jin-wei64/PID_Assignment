<?php 
require_once ("config.php");
$link = mysqli_connect($dbhost ,$dbuser ,$dbpass ,$dbname ,8889) or die(mysqli_connect_error());
$sqlCommand = <<<sqlQuery
                select * from client;
                sqlQuery;
$result = mysqli_query($link ,$sqlCommand);
// var_dump($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lab</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<script src="scripts/jquery-1.9.1.min.js"></script>
<script src="scripts/jquery.mobile-1.3.2.min.js"></script>
<link rel="stylesheet" href="scripts/jquery.mobile-1.3.2.min.css" />
<link rel="stylesheet" href="styles.css" />
</head>
<body>
<div data-role="page" data-theme="c">

<div data-role="header">
	<h1>Client</h1>
</div>

<div data-role="content">
	<ul data-role="listview" data-filter="true">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
		<li>
            <a href="employeeDetails.php?id=<?= $row["clientid"] ?>"> 
                <h4>Account :<?= $row['clientAccount'] ?></h4>
                <p>Name :<?= $row["clientName"] ?></p> 
                <span class="ui-li-count"><?= $row["orderquantity"] == 0 ? "0" : $row["orderquantity"] ?></span>
            </a>
		</li>
    <?php } ?>    
	</ul>
</div>

</div>
</body>
</html>