<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
    {
        header('location:index.php');
    }
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }
?>
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
			<?php include("navlight.php");?>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 col-xs-10">
					<!-- 上傳展覽 -->
					<form class="form-horizontal">
						<div class="form-group">
							<label for="mName" class="col-sm-4 control-label">
								<font color="#FFFFFF" face="thin" size="3px">展館名稱</font>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="mName" name="mName">
							</div>
						</div>
						<div class="form-group">
							<label for="logo" class="col-sm-4 control-label">
								<font color="#FFFFFF" face="thin" size="3px">LOGO</font>
							</label>
							<div class="col-sm-8">
								<input type="file" id="logo">
							</div>
						</div>
						<button type="submit" class="btn btn-default">完成</button>
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