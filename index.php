<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css"  rel="stylesheet"/>
	</head>
	<body class="bg-brown align-center">
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<img src="img/logo.png" id="index-logo">
					<!-- 登入帳密 -->
					<form class="form-horizontal">
					  	<div class="form-group">
							<input type="text" class="form-control" name="account" id="account" placeholder="帳號">
					  	</div>
					  	<div class="form-group">
					      	<input type="password" class="form-control" name="password" id="password" placeholder="密碼">
					  	</div>
						<div class="form-group">
						    <button type="submit" class="btn btn-default">登入</button>
						</div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>