<?php
	if(isset($_POST['test'])){
        $test = $_POST['test'];
		$array = [];
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = 'root';
		$dbname = 'shopping';
		$link = mysqli_connect ( $dbhost, $dbuser, $dbpass, $dbname, 8889 ) or die ( mysqli_connect_error() );
		$result = mysqli_query ( $link, "set names utf8");
		$sql = "select p.productName,o.productId, SUM(quantity) as total 
		FROM `orderdetails` as o JOIN products as p on o.productId = p.productId GROUP by productId" ;
		$a =mysqli_query($link,$sql);
		while($b = mysqli_fetch_assoc($a)){
			$array[] = array('x'=>$b['productName'],'y'=>$b['total']);
		}
		echo json_encode($array);
	}
?>