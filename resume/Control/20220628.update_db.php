<?php
//1. 完成更新基本語法
//2. 改寫成API
//	INPUT: {"pname":"咖啡13","pnum":"10","premark":"咖啡13咖啡13", "ID": "10"}
//	OUTPUT: 
// 	{"state": true, "message":"更新成功!"}
// 	{"state": false, "message":"更新失敗!"}
// 	{"state": false, "message":"欄位不得為空白!"}
// 	{"state": false, "message":"API規定的欄位不存在!"}
//後來發現的問題補充
//{"state": false, "message":"更新失敗, 語法成功但無此欄位!"}

	$data = file_get_contents("php://input", "r");
	$mydata = array();
	$mydata = json_decode($data, true);
	if(isset($mydata["ID"]) && isset($mydata["pname"]) && isset($mydata["pnum"]) && isset($mydata["premark"])){
		if($mydata["ID"] != "" && $mydata["pname"] != "" && $mydata["pnum"] != "" && $mydata["premark"] != ""){
			$p_ID = $mydata["ID"];
			$p_pname = $mydata["pname"];
			$p_pnum = $mydata["pnum"];
			$p_premark = $mydata["premark"];

			$servername = "localhost";
			$username = "owner";
			$password = "123456";
			$dbname = "productdb";

			$link = mysqli_connect($servername, $username, $password, $dbname);
			mysqli_query($link, "SET NAMES utf8");

			if(!$link){
				die("連線錯誤!".mysqli_connect_error());
			}

			$sql = "UPDATE product SET P_name = '$p_pname', P_num = '$p_pnum', P_remark = '$p_premark' WHERE ID = '$p_ID'";

			if(mysqli_query($link, $sql)){
				if(mysqli_affected_rows($link) == 1){
					echo '{"state": true, "message":"更新成功!"}';
				}else{
					echo '{"state": false, "message":"更新失敗, 語法成功但無此欄位!"}';
				}
				// echo '{"state": true, "message":"更新成功!"'.mysqli_affected_rows($link).'}';
			}else{
				echo '{"state": false, "message":"更新失敗!"}';
			}
			mysqli_close($link);
		}else{
			echo '{"state": false, "message":"欄位不得為空白!"}';
		}
	}else{
		echo '{"state": false, "message":"API規定的欄位不存在!"}';
	}

?>