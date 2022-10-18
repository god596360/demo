<?php
	// $p_pname = $_POST["pname"];
	// $p_pnum = $_POST["pnum"];
	// $p_premark = $_POST["premark"];

	// $p_pname = "雞排便當01";

	//接收前端的json 字串資料
	//{"pname":"咖啡13","pnum":"10","premark":"咖啡13咖啡13"}
	$data = file_get_contents("php://input", "r");
	$mydata = array();
	$mydata = json_decode($data, true);

	//判斷欄位是否存在
	if(isset($mydata["pname"]) && isset($mydata["pnum"]) && isset($mydata["premark"])){
		//判斷欄位是否為空白
		if($mydata["pname"] != "" && $mydata["pnum"] != "" && $mydata["premark"] != ""){
			$p_pname = $mydata["pname"];
			$p_pnum = $mydata["pnum"];
			$p_premark = $mydata["premark"];

			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "productdb";

			$link = mysqli_connect($servername, $username, $password, $dbname);
			if(!$link){
				die("連線錯誤".mysqli_connect_error());
			}

			mysqli_query($link, "SET NAMES utf8");

			//新增資料
			$sql = "INSERT INTO product_work(P_name, P_num, P_remark) VALUES('$p_pname', '$p_pnum', '$p_premark')";

			if(mysqli_query($link, $sql)){
				echo '{"state": true, "message":"新增成功!"}';
			}else{
				echo '{"state": false, "message":"新增失敗!"}';
			}
			mysqli_close($link);
		}else{
			echo '{"state": false, "message":"欄位不得為空白!"}';
		}
	}else{
		echo '{"state": false, "message":"API規定的欄位不存在!"}';
	}
?>

