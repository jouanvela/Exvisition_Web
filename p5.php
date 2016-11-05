<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css"  rel="stylesheet"/>
	</head>
	<style type="text/css">
		td{height:55px;background-color: #9C856E;padding:8px;}
	</style>
	<body>
		<div class="container">
			<div class="row">
				<br>
				<div class="col-md-6"></div>
				<div class="col-md-6 col-xs-12" style="text-align:center;">
					<br>
					<!-- 登入後顯示xxx你好 -->
					<font color="#C1A685" face="thin">xxx你好</font>
					&nbsp<font color="#886600">|</font>&nbsp
					<!-- -->
					<a href="p3.html" class="a2">基本資料</a>&nbsp<font color="#886600">|</font>&nbsp
					<a href="" class="a2">聯絡我們</a>&nbsp<font color="#886600">|</font>&nbsp
					<a href="" class="a2">登出</a>
				</div>
				<br><br>
				<hr class="h1">
			</div>

			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 col-xs-12">
					<br><br><br><br>
					<!-- 編輯展品 -->
					<form>
						<!-- 編輯展品名稱 -->
					 	<div>
						    <label for="InputName">
						    	<font class="p5">展品名稱</font>
						    </label>
						    <input type="text" id="InputName">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 展品圖片 -->
					  	<div>
						    <label for="pic">
						    	<font class="p5">展品圖片</font>
						    </label>
						    <br><br>
						    <input type="file" id="pic">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 展品介紹 -->
					  	<div>
						    <label for="introduce">
						    	<font class="p5">展品介紹</font>
						    </label>
						    <br><br>
						    <textarea id="introduce"></textarea>
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 語音導覽 -->
					  	<div>
						    <label for="voice">
						    	<font class="p5">語音導覽</font>
						    </label>
						    <br><br>
						    <input type="file" id="voice">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 影片導覽 -->
					  	<div>
						    <label for="video">
						    	<font class="p5">影片導覽</font>
						    </label>
						    <br><br>
						    <input type="file" id="video">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 小遊戲 -->
					  	<div>
						  	<button class="game" onclick="disp_alert()" style="vertical-align:middle"><span>小遊戲</span></button>
						    <br><br>
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 送出 -->
					  	<div style="text-align:center;">
					  		<button type="submit" class="btn btn-default">送出</button>
						</div>
					</form>

				</div>
				<div class="col-md-3"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="game.js"></script>
	</body>
</html>