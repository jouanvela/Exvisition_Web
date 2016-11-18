<?php
	include("db.php");
	date_default_timezone_set("Asia/Taipei");
	header('Content-Type: text/html; charset=utf-8');

	$temp = md5(rand());

	if($_FILES["file"]["size"] > 0) {
		if($_FILES["file"]["error"] > 0) {
			echo false;
		}
		else {
			if(!is_dir("./img/member/")){
				mkdir("./img/member/", 0777,true);
				chmod('/img/member/', 0777);
			}
			move_uploaded_file($_FILES["file"]["tmp_name"],"./img/member/".$temp.".png");//移動檔案
			chmod("./img/member/".$temp.".png", 0777);
			echo $temp;
		}
	}
	else {
		echo false;
	}
?>