<?php
//	1. 完成刪除基本程式
//	2. 依照API規格表完成使程式
// input: {"ID": "10"}
// output:
// {"state": true, "message":"刪除成功!"}
// {"state": false, "message":"刪除失敗!"}
// {"state": false, "message":"欄位不得為空白!"}
// {"state": false, "message":"API規定的欄位不存在!"}
// {"state": false, "message":"刪除失敗, 語法成功但無此資料!"}
	
	$data = file_get_contents("php://input", "r");
	$mydata = array();
	$mydata = json_decode($data, true);

	if(isset($mydata["ID"])){
		if($mydata["ID"] != ""){
			$servername = "localhost";
			$username = "owner";
			$password = "123456";
			$dbname = "productdb";

			$p_id = $mydata["ID"];

			$link = mysqli_connect($servername, $username, $password, $dbname);
			if(!$link){
				die("連線錯誤!".mysqli_connect_error());
			}

			$sql = "DELETE FROM product WHERE ID = '$p_id '";
			if(mysqli_query($link, $sql)){
				if(mysqli_affected_rows($link) == 1){
					echo '{"state": true, "message":"刪除成功!"}';
				}else{
					echo '{"state": false, "message":"刪除失敗, 語法成功但無此資料!"}';
				}	
			}else{
				echo '{"state": false, "message":"刪除失敗!'.mysqli_error($link).'"}';
			}
			mysqli_close($link);
		}else{
			echo '{"state": false, "message":"欄位不得為空白!"}';
		}
	}else{
		echo '{"state": false, "message":"API規定的欄位不存在!"}';
	}
?>