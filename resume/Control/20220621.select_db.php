<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "productdb";

	//建立連線
	$link = mysqli_connect($servername, $username, $password, $dbname);

	//確認連線
	if(!$link){
		die("連線失敗".mysqli_connect_error());
	}

	//修改編碼模式
	mysqli_query($link, "SET NAMES utf8");

	//echo "連線成功！";

	$sql = "SELECT ID, P_name, P_num, P_remark ,P_created_at FROM product_work";
	$result = mysqli_query($link,$sql);

	// $row = mysqli_fetch_assoc($result);
	// echo $row["P_name"];
	$mydata = array();
	while($row = mysqli_fetch_assoc($result)){
		$mydata[] = $row; 
	}
	echo json_encode($mydata);
	
	mysqli_close($link);
?>	